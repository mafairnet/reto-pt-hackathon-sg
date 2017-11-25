'use strict';

var mongoose = require('mongoose');
var Schema = mongoose.Schema;


var TaskSchema = new Schema({
  main_topic: {
    type: String,
    required: 'Ingrese el titulo principal.'
  },
  topic: {
    type: String,
    required: 'Ingrese el titulo.'
  },
  number_replies: {
    type: Number,
    required: 'Ingrese el numero de respuestas del titulo'
  },
  replies: [{    
      type: String,
      required: 'Ingrese el comentario del titulo'    
  }],
  Created_date: {
    type: Date,
    default: Date.now
  }
});

module.exports = mongoose.model('Tasks', TaskSchema);