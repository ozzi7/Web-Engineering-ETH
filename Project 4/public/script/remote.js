var currentImage = 0; // the currently selected image
var imageCount = 7; // the maximum number of images available

// my variables
var socket;
var screenNameToConnectedBitHash = {};
var gammaRotBuffer = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0]; //size: 20
// var gammaRotBuffer = [0,0,0,0,0]; //size: 5
// var gammaRotBuffer = [0,0,0,0,0, 0, 0, 0, 0, 0]; //size: 10
var gammaRotBufferIndex = 0;
var ignore = 0;
var gammaThreshold = 300; // how many degrees per second does the user need to move to register as jerk motion?
var zoomLevel = 1;

function showImage (index){
    document.getElementById("debug2").innerHTML = 'show Image: ' + index;
    // Update selection on remote
    currentImage = index;
    var images = document.querySelectorAll("img");
    document.querySelector("img.selected").classList.toggle("selected");
    images[index].classList.toggle("selected");

    var i = 0;
    for (var screenName in screenNameToConnectedBitHash) {
      if (screenNameToConnectedBitHash[screenName] == 1) {
        var imageIndex = index + i;
        if (imageIndex > 6) {
          imageIndex = 6;
        }
        var data = {screenName: screenName, imageIndex: imageIndex};
        socket.emit('showImage', data);
        // alert('sent show image: ' + imageIndex + ' to screen: ' + screenName);
        i++;
      }
    }
}

function zoomImage(level) {
    document.getElementById("debug4").innerHTML = 'zoom level: ' + level;

    zoomLevel = level;

    for (var screenName in screenNameToConnectedBitHash) {
        if (screenNameToConnectedBitHash[screenName] == 1) {
            var data = {screenName: screenName, zoomLevel: zoomLevel};
            socket.emit('zoomImage', data);
            // alert('sent zoom image: ' + zoomLevel + ' to screen: ' + screenName);
        }
    }
}

function initialiseGallery(){
    var container = document.querySelector('#gallery');
    var i, img;
    for (i = 0; i < imageCount; i++) {
        img = document.createElement("img");
        img.src = "images/" +i +".jpg";
        document.body.appendChild(img);
        var handler = (function(index) {
            return function() {
                showImage(index);
            }
        })(i);
        img.addEventListener("click",handler);
    }

    document.querySelector("img").classList.toggle('selected');
}

document.addEventListener("DOMContentLoaded", function(event) {
    initialiseGallery();

    document.querySelector('#toggleMenu').addEventListener("click", function(event){
        var style = document.querySelector('#menu').style;
        style.display = style.display == "none" || style.display == ""  ? "block" : "none";
    });

    if (window.DeviceOrientationEvent) {
      window.addEventListener('deviceorientation', function(eventData) {
          // gamma is the left-to-right tilt in degrees, where right is positive
          var tiltLR = eventData.gamma;

          // beta is the front-to-back tilt in degrees, where front is positive
          var tiltFB = eventData.beta;

          // alpha is the compass direction the device is facing in degrees
          var dir = eventData.alpha

          // call our orientation event handler
          deviceOrientationHandler(tiltLR, tiltFB, dir);
        }, false);
    }

    if (window.DeviceMotionEvent) {
      window.addEventListener('devicemotion', deviceMotionHandler, false);
    }

    connectToServer();
});

function deviceOrientationHandler(tiltLR, tiltFB, dir) {
    var newZoomLevel = zoomLevel;

    if (tiltFB < 90 && tiltFB > 70) {
        newZoomLevel = 1;
    } else if (tiltFB <= 70 && tiltFB > 50) {
        newZoomLevel = 1.25;
    } else if (tiltFB <= 50 && tiltFB > 30) {
        newZoomLevel = 1.5;
    } else if (tiltFB <= 30 && tiltFB > 10) {
        newZoomLevel = 2;
    }

    if (newZoomLevel != zoomLevel) {
        zoomImage(newZoomLevel);
    }
}

function deviceMotionHandler(eventData) {
  document.getElementById("debug1").innerHTML = 'current gamma index: ' + gammaRotBufferIndex ;
  document.getElementById("debug3").innerHTML = 'ignore: ' + ignore;
  document.getElementById("debug4").innerHTML = 'gammaPerSec: ' + eventData.rotationRate.gamma;;
  if (ignore == 1) {
    if (gammaRotBufferIndex == gammaRotBuffer.length-1) {
      ignore = 0;
    }
  }
  else { // no ignore
    var gammaPerSec = eventData.rotationRate.gamma;
    gammaRotBuffer[gammaRotBufferIndex] = gammaPerSec;

    if (gammaRotBufferIndex == gammaRotBuffer.length-1) {
      var min = findMinInArray(gammaRotBuffer);
      var max = findMaxInArray(gammaRotBuffer);

      if (max > gammaThreshold && min > -gammaThreshold) {
        if (currentImage == imageCount - 1) {
          showImage(currentImage);
        }
        else { // currentImage < imageCount
          showImage(currentImage + 1);
        }
        ignore = 1;
      }
      else if (min < -gammaThreshold && max < gammaThreshold) {
        if (currentImage == 0) {
          showImage(0);
        }
        else { // currentImage > 0
          showImage(currentImage - 1);
        }
        ignore = 1;
      }
      else {
          // document.getElementById("debug3").innerHTML = 'spastic movement: activate';
      }
    }
  }

  if (gammaRotBufferIndex == gammaRotBuffer.length-1) {
    gammaRotBufferIndex = 0;
  }
  else {
    gammaRotBufferIndex++;
  }


  // var rotation = eventData.rotationRate;
  // document.getElementById("debug1").innerHTML = rotation.gamma;
  //
  // // // Grab the refresh interval from the results
  // info = eventData.interval; // 50 ms
  // document.getElementById("debug2").innerHTML = info + ' ms';
}

function findMinInArray(array) {
  var min = array[0];
  for (i = 0; i < array.length; i++) {
    if (array[i] < min) {
      min = array[i];
    }
  }
  return min;
}

function findMaxInArray(array) {
  var max = array[0];
  for (i = 0; i < array.length; i++) {
    if (array[i] > max) {
      max = array[i];
    }
  }
  return max;
}


function connectToServer(){
    socket = io('/remoteNamespace');

    socket.on('newScreen', function(screenName){
      screenNameToConnectedBitHash[screenName] = 0;
      redrawScreenSelection();
    });

    socket.on('screenClosed', function(screenName){
      delete screenNameToConnectedBitHash[screenName];
      redrawScreenSelection();
    })
}

function redrawScreenSelection() {
  var ul = document.getElementById('deviceList');
  ul.innerHTML = '';

  for (var screenName in screenNameToConnectedBitHash) {
    var li = document.createElement('li');
    li.appendChild(document.createTextNode(screenName));
    li.setAttribute('id', screenName);
    var button = document.createElement('button');
    if (screenNameToConnectedBitHash[screenName] == 0) {
      button.innerHTML = 'Connect';
    }
    else {
      button.innerHTML = 'Disconnect';
    }

    button.onclick = function(name){return function() {handleConnectButtonClick(name); }; }(screenName); // closure

    li.appendChild(button);
    ul.appendChild(li);
  }
}

function handleConnectButtonClick(screenName) {
  // alert('sending connect message to ' + screenName);

  if (screenNameToConnectedBitHash[screenName] == 1) {
    socket.emit('disconnectScreen', screenName);
    screenNameToConnectedBitHash[screenName] = 0;
  }
  else {
    socket.emit('connectScreen', screenName);
    screenNameToConnectedBitHash[screenName] = 1;
  }

  redrawScreenSelection();
}
