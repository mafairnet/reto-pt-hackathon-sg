'use strict';


var mongoose = require('mongoose'),
  Task = mongoose.model('Tasks');

exports.list_all_tasks = function(req, res) {
  Task.find({}, function(err, task) {
    if (err)
      res.send(err);
    res.json(task);
  });
};


exports.create_a_task = function(req, res) {
  console.log(req.body);
  var new_task = new Task(req.body);
  new_task.save(function(err, task) {
    if (err)
      res.send(err);
    res.json(task);
  });
};


exports.read_a_task = function(req, res) {
  Task.findById(req.params.taskId, function(err, task) {
    if (err)
      res.send(err);
    res.json(task);
  });
};


exports.update_a_task = function(req, res) {
  Task.findOneAndUpdate({_id: req.params.taskId}, req.body, {new: true}, function(err, task) {
    if (err)
      res.send(err);
    res.json(task);
  });
};


exports.delete_a_task = function(req, res) {
  Task.remove({
    _id: req.params.taskId
  }, function(err, task) {
    if (err)
      res.send(err);
    res.json({ message: 'Task successfully deleted' });
  });
};

exports.delete_all_task = function(req, res) {
  Task.remove({
    
  }, function(err, task) {
    if (err)
      res.send(err);
    res.json({ message: 'Task successfully deleted' });
  });
};

exports.account_status = function(req, res) {
  getBitsonAccount("account_status", function(data){
    res.json(JSON.parse(data));
  });
};

exports.balance = function(req, res) {
  getBitsonAccount("balance", function(data){
    res.json(JSON.parse(data));
  });
};

function getBitsonAccount(params, callback){
  var key = "ckdgeYbliM";
  var secret = "daf63f033d3b48855998c776990a023e";
  var nonce = new Date().getTime();
  var http_method="GET";
  var json_payload=""
  var request_path="/v3/"+params+"/"

  // Create the signature
  var Data = nonce+http_method+request_path+json_payload;
  var crypto = require('crypto');
  var signature = crypto.createHmac('sha256', secret).update(Data).digest('hex');

  // Build the auth header
  var auth_header = "Bitso "+key+":" +nonce+":"+signature;


  var options = {
    host: 'api.bitso.com',
    port: 80,
    path: '/v3/'+params+'/',
    method: 'GET',
    headers: {
          'Authorization': auth_header
      }
  };

  // Send request
  var http = require('http');
  var req = http.request(options, function(res) {
      res.on('data', function (chunk) {
          callback(chunk);          
      });
  });
  req.end();  
};