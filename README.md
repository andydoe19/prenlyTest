## Requirements
This application requires the following to be installed
- PHP 7 and above
- nodejs
- composer

## How to Run this application
After downloading or pulling this project from Github, run the command below to install and update
the node module:

`$ npm install`

You can also run the command below to update your PHP libraries. Though it might not be necessary, becuase I included the `vendor` folder in the initial push of the project. The command however is : 

`$ composer install`

Next is to check the database configurations, by opening the .env file. In this file, we see that the database name is 'prenlytest'. Hence run and open up your mysql database and create the database 'prenlytest'. If you have a different database username, password and port number, you can change them here.

After checking the database configurations, you need to create the tables by running the command below:

`$ php artisan migrate`

Now you can run the servers. First, you run the Laravel server so you can access the application with the command below:

`$ php artisan serve`

Secondly, you run a custom nodejs server which I use to get the full content of any article a user wants to view. You run it with the command below:

`$ node artparser.js`

Hurrayyy! Now you can access the application at the url : http://localhost:8000/


## Summary of application structure
This is a Laravel MVC (Model View Controller) application, hence it follows that structure.

The frontend or the views can be found in the `resources > views` folder. This folder consist of the following: 
- [auth folder] This folder consist of the login, register and reset password pages
- [layout folder] This folder holds the layout which all the views inherit from
- [index page] This is the welcome or home page, it displays all the news articles with the selected news source
- [single page] This page displays full details of an article with comments functionality.
- [news partial & news_hightlights partial pages] These two pages are used by ajax request to return data that updates portions of the index page.

The next important folder is the controllers folder which can be found in the `app > Http > Controllers` folder. In here, I use the ApiController and HomeController to handle all requests coming from the pages. The endpoints or routes are first specified in the `route > web.php` file. In this file, various routes are mapped with their controller functions, so this file tells which controller function is called for a particular route the user accesses.

Next is the models folder, which can be found in the `app > Models` folder. It contains the following :
- [Api file] This file contains functions for making api calls for data from the newsapi.org. It does so with the help of the Helper class found in `app > Helpers` folder.
- [Message file] This file enables the application to interraction with the message database table. It enables the application to save, read, update, delete and perform many database operations on the message table in the database.
- [User file] This file enables the application to interraction with the user database table. It enables the application to save, read, update, delete and perform many database operations on the user table in the database.

Finally, I created a custom nodejs server, which can be found in the file `artparser.js` and located in the root folder of the application. This server uses `article-parser` plugin to retrieve information about any news article. This is the file I use to get the full content of any article the user wants to read more on.

# Thank you