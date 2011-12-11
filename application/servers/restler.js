var sys = require('util'),
    rest = require('restler');

rest.post('http://localhost:8000/message').on('complete', function(data) {
  sys.puts(data);
  console.log(data);
});

//rest.get('http://twaud.io/api/v1/users/danwrong.json').on('complete', function(data) {
//  sys.puts(data[0].message); // auto convert to object
//});

//rest.get('http://twaud.io/api/v1/users/danwrong.xml').on('complete', function(data) {
//  sys.puts(data[0].sounds[0].sound[0].message); // auto convert to object
//});

rest.post('http://admin:secret@localhost:8000/message', {
  data: { message: 334 },
}).on('complete', function(data, response) {
  if (response.statusCode == 201) {
    // you can get at the raw response like this...
  }
  console.log(data);
});

//// multipart request sending a file and using https
//rest.post('https://twaud.io/api/v1/upload.json', {
//  multipart: true,
//  username: 'danwrong',
//  password: 'wouldntyouliketoknow',
//  data: {
//    'sound[message]': 'hello from restler!',
//    'sound[file]': rest.file('doug-e-fresh_the-show.mp3', 'audio/mpeg')
//  }
//}).on('complete', function(data) {
//  sys.puts(data.audio_url);
//});

//// create a service constructor for very easy API wrappers a la HTTParty...
//Twitter = rest.service(function(u, p) {
//  this.defaults.username = u;
//  this.defaults.password = p;
//}, {
//  baseURL: 'http://twitter.com'
//}, {
//  update: function(message) {
//    return this.post('/statuses/update.json', { data: { status: message } });
//  }
//});

//var client = new Twitter('danwrong', 'password');
//client.update('Tweeting using a Restler service thingy').on('complete', function(data) {
//  sys.p(data);
//});

//// the JSON post
//rest.post('http://example.com/action', {
//  data: JSON.stringify({ id: 334 }),
//}).on('complete', function(data, response) {
//  // you can get at the raw response like this...
//});
