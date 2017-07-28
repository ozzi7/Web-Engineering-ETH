var express = require('express');
var app = express();
var http = require('http').Server(app);
var io = require('socket.io')(http);

// my variables
var socketIdToScreenNameHash = {};
var screenNameToSocketIdHash = {};
var screenNameToRemoteSocketIdHash = {};

app.use(express.static('public'));

var screenIO = io.of('/screenNamespace');
var remoteIO = io.of('/remoteNamespace');

screenIO.on('connection', function(socket){
  console.log('received screen connection with socketId: ' + socket.id);

  socket.on('register', function(screenName){
    console.log('screen with screen name: ' + screenName + ' registered with socketId: ' + socket.id);
    socketIdToScreenNameHash[socket.id] = screenName;
    screenNameToSocketIdHash[screenName] = socket.id;
    screenNameToRemoteSocketIdHash[screenName] = 'none';

    remoteIO.emit('newScreen', screenName);
  });

  socket.on('disconnect', function(){
    console.log('screen with socket id: ' + socket.id + ' disconnected');
    var screenName = socketIdToScreenNameHash[socket.id];
    delete socketIdToScreenNameHash[socket.id];
    delete screenNameToSocketIdHash[screenName];
    delete screenNameToRemoteSocketIdHash[screenName];

    remoteIO.emit('screenClosed', screenName);
  });

});

remoteIO.on('connection', function(socket){
  console.log('received remote connection with socketId: ' + socket.id);

  for (var screenName in screenNameToSocketIdHash) {
    remoteIO.to(socket.id).emit('newScreen', screenName);
  }

  socket.on('connectScreen', function(screenName){
    console.log('received connectScreen: ' + screenName + ' message from ' + socket.id);
    screenNameToRemoteSocketIdHash[screenName] = socket.id;
  });

  socket.on('disconnectScreen', function(screenName){
    console.log('received disconnectScreen: ' + screenName + ' message from ' + socket.id);
    screenNameToRemoteSocketIdHash[screenName] = 'none';

    var socketId = screenNameToSocketIdHash[screenName];
    screenIO.to(socketId).emit('clearImage', '');
  });

  socket.on('showImage', function(data){
    var screenName = data.screenName;
    var imageIndex = data.imageIndex;

    console.log('received showImage insstruction for screen: ' + screenName + ' with image: ' + imageIndex);

    var socketId = screenNameToSocketIdHash[screenName];
    screenIO.to(socketId).emit('showImage', imageIndex);
  });
  
  socket.on('zoomImage', function(data) {
    var screenName = data.screenName;
    var zoomLevel = data.zoomLevel;
    
    console.log('received zoomImage instruction for screen: ' + screenName + ' with zoom level: ' + zoomLevel);
    
    var socketId = screenNameToSocketIdHash[screenName];
    screenIO.to(socketId).emit('zoomImage', zoomLevel);
  });

  socket.on('disconnect', function(){
    console.log('remote with socket id: ' + socket.id + 'disconnected');

    for (var screenName in screenNameToRemoteSocketIdHash) {
      var remoteSocketId = screenNameToRemoteSocketIdHash[screenName];
      if (remoteSocketId == socket.id) {
        var socketId = screenNameToSocketIdHash[screenName];
        screenIO.to(socketId).emit('clearImage', '');
        screenNameToRemoteSocketIdHash[screenName] = 'none';
      }
    }
  });

});

http.listen(8080, function(){
    console.log('starting server...');
    console.log('listening on *:8080');
});
