function assertStatus(code) {
  return function (res, $) {
    res.should.have.status(code)
  }
}

var client = {
  get: function(path) {
    return function() {
      browser.get(path, { headers: defaultHeaders }, this.callback)
    }
  },
  post: function(path, data) {
    return function() {
       browser.post(path, { body: JSON.stringify(data), headers: defaultHeaders }, this.callback)
    }
  }
}

rest.post('http://admin:secret@localhost:8000/message', {
  data: { message: 334 },}).on('complete', function(data, response) {
  if (response.statusCode == 201) {
    // you can get at the raw response like this...
  }
  //console.log(response);
});

