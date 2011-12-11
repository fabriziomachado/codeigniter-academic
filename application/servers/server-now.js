var nowjs = require("now"),
    express = require('express'),
    auth = require('basic-auth');
    
// create server
var server = express.createServer();
server.configure(function () {
  server.use(express.logger());
  server.use(auth.basicAuth);
  server.use(express.bodyParser()); 
  server.use(express.static(__dirname + '/public'));
});

var everyone = nowjs.initialize(server);
server.listen(8000);

// rest route
server.post('/resize', function(req, res){
  everyone.now.resize(req.body.message);  
  res.send(200);
});

// rest route
server.post('/message', function(req, res){
console.log(req.body);
  everyone.now.notify(req.body.title , req.body.message);
  res.send(200);
});

// channel in server
everyone.now.ping = function(self){
   eval(self).now.pong('PONG', this.user.clientId);
};


// events
nowjs.on('connect', function () {
  console.log(this.user.clientId + ' Conectou');
  
});

nowjs.on('disconnect', function () {
  console.log(this.user.clientId + ' Desconectou');
});


