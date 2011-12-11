// division-by-zero-test.js

var vows = require('vows'),
    assert = require('assert');


var api = {
    get: function (path) {
        return function () {
            client.get(path, this.callback);
        };
    }
};



// Create a Test Suite
exports.suite1 = vows.describe('Division by Zero').addBatch({
    'when dividing a number by zero': {
        topic: function () { return 42 / 0 },

        'we get Infinity': function (topic) {
            assert.equal (topic, Infinity);
        }
    },
    
    'but when dividing zero by zero': {
        topic: function () { return 0 / 0 },

        'we get a value which': {
            'is not a number': function (topic) {
                assert.isNaN (topic);
            },
            'is not equal to itself': function (topic) {
                assert.notEqual (topic, topic);
            }
        }
    }
}); // Run it


