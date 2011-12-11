
var url = 'http://localhost/codeigniter-academic/assets/images/photos/';

// with NowJs
$(document).ready(function(){
  // JQuery notify 
  $container = $("#container").notify();

  //Channel to emit notify 
  now.notify = function(title, message){
     $("#container").notify("create", "sticky", { 
        title: title, 
        text: message
    });
  }

  //Channel to emit resize 
  now.resize = function(message){
     $("#photos").append("<img src='" + url + message + "'/ >");
     $("#container").notify("create", "sticky", { 
        title: 'RESIZE IMAGE', 
        text: message
    });
  }


  // Channel to emit pong message
  now.pong = function(title, message){
    $("#container").notify("create", "sticky", { 
        title: title, 
        text: message
    });
  }	  
  
  $('#ping-pong-everyone').click(function() {
      now.ping('everyone'); // function server
  });
  $('#ping-pong-this').click(function() {
      now.ping('this'); // function server
  });
	
	
});     




// with faye
//var url = 'http://localhost/codeigniter-academic/assets/images/photos/';
//var client = new Faye.Client('http://localhost:8000/faye', {
//  timeout: 120
//});


//client.subscribe('/channel-1', function(message) {
//     $("#photos").append("<img src='" + url + message.text + "'/ >");
//     
//     $("#container").notify("create", "sticky", { 
//        title:'Upload Successsufully', 
//        text:message.text
//    });
//});


//client.subscribe('/channel-2', function(message) {
//     $("#container").notify("create", "sticky", { 
//        title:message.title, 
//        text:message.text
//    });
//});


