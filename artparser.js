/**
 * Using Express as server
 */
const { extract } = require('./node_modules/article-parser/dist/cjs/article-parser.js')

 //include express
 const express = require('express')

 //include cors, to allow all external domains to access
 const cors = require('cors')
 
 //initialize express with cors
 const serv = express();
 serv.use(cors())
 
 //GET request at '/' route
 serv.get('/', function(req, res) {
 
     //get article url parameter from request
     let articleUrl = req.query.url
 
     console.log('retrieving full article content for url --->')
     console.log(articleUrl)
 
     //call library to extract article
     extract(articleUrl).then((article) => {
         
         //log extaction output
        //  console.log('output >>>>')
        //  console.log(article)
 
         //return extaction output as json
         res.json(article)
     }).catch((err) => {
         console.trace(err)
     })
 
 })
 
 //server params
 const hostname = '127.0.0.1';
 const port = 3008;
 
 //start server
 serv.listen(port, function(req, res) {
     console.log(`---> Article Parser Server running at http://${hostname}:${port}/`);
     console.log('---> Sample request to the server will be >>  http://127.0.0.1:3008/?url=article_url_beginning_with_http');
 })