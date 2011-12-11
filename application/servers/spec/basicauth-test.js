var vows = require('vows'),
    assert = require('assert'),
    should = require('should'),
    tobi = require('tobi'),
    http = require('http');
 
var HOST = 'localhost',
    PORT = 8087;
 
var suite = vows.describe('My API Security'),
    browser = tobi.createBrowser(PORT, HOST);
 
var client = {
  get: function(path, header, callback) {
    browser.get(path, { headers: header }, callback)
  },
  post: function(path, data, header, callback) {
    browser.post(path, { body: JSON.stringify(data), headers: header }, callback)
  }
}
 
//
//Send a request and check the response status.
//
function respondsWith(res) {
  var context = {
    topic: function () {
      // Get the current context's name, such as "POST / access_token"
      // and split it at the spaces.
      var req    = this.context.name.split(/ +/), // ["POST", "/", "access_token"]
          method = req[0].toLowerCase(),          // "post"
          path   = req[1];                        // "/"
          token  = req[2];                        // "access_token"
 
      var header = { 'Authorization': 'Bearer ' + token };
 
      // Perform the contextual client request,
      // with the above method and path.
      client[method](path, header, this.callback);
    }
  };
 
  // Create and assign the vows to the context.
 
  context['should respond with a ' + status + ' '
         + http.STATUS_CODES[status]] = assertStatus(res.status);
 
  errorMessage = (error == undefined) ? 'out errors' : ' an "'+error+'" error';
  context['should respond with' + errorMessage] = assertHeaders(res.error, res.errorDescription);
 
  return context;
}
 
function assertStatus(code) {
  return function (res, $) {
    res.should.have.status(code)
  }
}
 
function assertHeaders(error, errorDescription) {
  return function (res, $) {
    if (error || errorDescription) {
      res.should.have.header('www-authenticate');
      header = oauth.parseAuthenticationHeader(res.headers['www-authenticate']);
      if (error) error.should.equal(header.error);
      if (errorDescription) errorDescription.should.equal(header.error_description);
    } else {
      res.should.not.have.property('www-authenticate');
    }
  }
}
 
suite.addBatch({
  'GET /resource/1 authorized': respondsWith({ status: 200 }),
  'GET /resource/1 un@vth0riz3d': respondsWith({ status: 401, error: 'invalid_token', errorDescription: 'The access token is invalid' }),
  'GET /resource/1 expired': respondsWith({ status: 401, error: 'invalid_token', errorDescription: 'The access token is expired' }),
  'GET /resource/1 insufficient': respondsWith({ status: 403, error: 'insufficient_scope' })
})
 
suite.export(module)
