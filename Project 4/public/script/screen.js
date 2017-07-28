var devicename; // the name of this screen and specified in the URL
var imageCount = 7; // the maximum number of images available

var socket;

document.addEventListener("DOMContentLoaded", function(event) {
    devicename = getQueryParams().name;
    if (devicename) {
        var text = document.querySelector('#name');
        text.textContent = devicename;
    }

    connectToServer();
});

function showImage (index){
    var img = document.querySelector('#image');
    var msg = document.querySelector('#msg');
    if (index >= 0 && index <= imageCount){
        img.setAttribute("src", "images/" +index +".jpg");
        msg.style.display = 'none';
        img.style.display = 'block';
    }
}


function clearImage(){
    var img = document.querySelector('#image');
    var msg = document.querySelector('#msg');
    img.style.display = 'none';
    msg.style.display = 'block';
}

function zoomImage(zoomLevel) {
    var img = document.querySelector('#image');
    img.style.webkitTransform = "scale("+zoomLevel+")";
}

function getQueryParams() {
    var qs =  window.location.search.split("+").join(" ");

    var params = {}, tokens,
        re = /[?&]?([^=]+)=([^&]*)/g;

    while (tokens = re.exec(qs)) {
        params[decodeURIComponent(tokens[1])]
            = decodeURIComponent(tokens[2]);
    }

    return params;
}


function connectToServer(){
    socket = io('/screenNamespace');
    socket.emit('register', devicename);

    socket.on('showImage', function(imageIndex){
        // alert('received showImage instruction with index: ' + imageIndex);
        showImage(imageIndex);
    });

    socket.on('clearImage', function(nothing){
      clearImage();
    });
    
    socket.on('zoomImage', function(zoomLevel) {
        // alert('received zoomImage instruction with level: ' + zoomLevel);
        zoomImage(zoomLevel);
    });
}
