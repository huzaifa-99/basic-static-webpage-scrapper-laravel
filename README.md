# Basic-Static-Webpage-Scrapper-Laravel
Scraps the contents of a static webpage using Symfony DomCrawler, built on Laravel.

# Tecnologies 
  * PHP-Laravel Framework
  * Symfony DomCrawler Component
  * MySQL
  * cURL
  * PHP-Insight

# Interface
There are signup/login buttons on the landing page, currently only the admin user has an interface in which after login, he can perform operations like below

### Add Scraping Sources
The admin can add/set up sources from which the content is to be scraped, for that he first has to add a node list for title, body, publish-date e.t.c.

### Fetch Articles From Webpages Sources
On clicking this button, a new tab is opened which just dumps (laravel dump() function) the content it has fetched on the screen.

### Add a Custom Article
The admin can also add a custom article which will be labeled as `Added by Site`

### Rate Polarities
This will rate the content fetched to be either positive, negative or neutral, rates the content based on a pre-set of words using PHP-Insight. 

# Project Installation
 * Download the project and unzip. 
 * Next, the `code` folder must be placed into the `htdocs` folder.
 * Change your current working directory to the `code` folder and run `composer install` for `/vendor` and `npm install` for `node_modules`, `vendor` folder is required for the code to work correctly.
 * Database (in `database` folder) must be imported into MySQL for the code to function properly, Database username and password are the default ones for Xampp.
 * To run the project, use command `php artisan serve` in the current directory with cmd and go to the server url, which will take you to the `home` page. The process after that is already explained above.

# Project Demo
A demo video is available on [https://youtu.be/fvPdwntuhPk]. Previews are also available on this repo in `Previews` Folder

# More Info
The project was created 10 months before today(8/9/2020) on Laravel-6.0 version.

The main aim of this project was for me to understand ***HTTP/S***,***cURL*, ***Web Scraping*** and ***sentiment analysis based on words*** in a web application. This was my eight project on web-development.
