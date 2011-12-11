// push data with curl
// curl -X POST -H "Content-Type:application/json" -d '{"message":"hello nodecasts.org"}' http://localhost:8000/message
// curl -X POST -H "Content-Type:application/x-www-form-urlencoded" -d 'message=hello using html form' http://localhost:8000/message
// curl -X POST -H "Content-Type:application/json" -d '{"message":"hello nodecasts.org"}' http://localhost:8000/message
var faye = require('faye'),
    express = require('express');

var bayeux = new faye.NodeAdapter({
        mount: '/faye', 
        timeout: 45
    });

// create server
var server = express.createServer();
server.configure(function () {
  server.use(express.methodOverride());
  server.use(express.bodyParser());
  server.use(express.static(__dirname + '/public'));
});

// rest route
server.post('/resize', function(req, res){
  bayeux.getClient().publish('/channel-1', { text: req.body.message });
  res.send(200);
  //res.send(req.body);
});

// rest route
server.post('/message', function(req, res){
  bayeux.getClient().publish('/channel-2', { title: req.body.title , text: req.body.message });
  res.send(200);
  //res.send(req.body);
});

bayeux.attach(server);
server.listen(8000);
