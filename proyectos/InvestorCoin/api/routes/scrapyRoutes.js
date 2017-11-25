'use strict';
module.exports = function(app) {
  var scrapy = require('../controllers/scrapyController');

  // scrapy Routes
  app.route('/scrapy')
    .get(scrapy.list_all_tasks)
    .post(scrapy.create_a_task)
    .delete(scrapy.delete_all_task);


  app.route('/scrapy/:scrapyId')
    .get(scrapy.read_a_task)
    .put(scrapy.update_a_task)
    .delete(scrapy.delete_a_task);

  app.route('/account_status')
  	.get(scrapy.account_status);

  app.route('/balance')
  	.get(scrapy.balance);
};