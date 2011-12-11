// division-by-zero-test.js

var vows = require('vows'),
    assert = require('assert'),
    tobi = require('tobi'),
    auth = require('basic-auth')


var suite = vows.describe('Server NowJS')
  , now = new Date().getTime()
  , newUser = { name: now + '_test_user', email: now + '@test.com' }
  , message = 'title:fabrizio'
  , browser = tobi.createBrowser(8000, 'localhost')
  , username = 'admin'
  , password = 'secret'
  , auth = 'Basic ' + new Buffer(username + ':' + password).toString('base64')
  , defaultHeaders = { 'Authorization': auth,'Content-Type': 'application/x-www-form-urlencoded' }


// support functions
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
  post: function(path, data, headers) {
    return function() {
       browser.post(path, { body: JSON.stringify(data), headers: headers }, this.callback)
    }
  }
}




  
// Create a Test Suite
exports.suite1 = suite.addBatch({
   
   'POST /resize': {
   
       'with valid credentials': {
            topic: client.post('/resize', message, defaultHeaders),
            'should respond with a 200 ok': assertStatus(200)
        },
        'with invalid credentials': {
            topic: client.post('/resize', message, {}),
            'should respond with a 401-Unauthorized': assertStatus(401)
        },
        
    },
    
    'POST /message': {
   
       'with valid credentials': {
            topic: client.post('/message', message, defaultHeaders),
            'should respond with a 200 ok': assertStatus(200)
        },
         'with invalid credentials': {
            topic: client.post('/message', message),
            'should respond with a 401-Unauthorized': assertStatus(401)
        },
        
    },
    
    
}); // Run it


