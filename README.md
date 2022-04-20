# city-content-managment-system
Content managment system for city website

#Setup Instructions
###System Requirements

PHP 7.3
Symfony 5.4
MySQL 5.7
Node.js
NPM
Composer
Web server: Apache or local symfony web server or NGINX

###Installation Steps

clone git repo to local machine
cd to project dir
run composer install
copy .env.dist into .env
copy .env into .env.local
update DATABASE_URL inside .env.local to point to your instance of the database
update MAILER_URL to reflect local mail settings. Advisable to create account in mailtrap.io and use it for local development.
run scrips/recreate_db.sh or scripts/database_recreate.bat (for Windows)
run npm install (to install JS dependencies)
run npm run dev (to compile front-end assets)

###Working with images
All front-end assets are located inside /assets dir. Place your static image files inside assets/images. When running the command npm run dev, or npm run watch - the images will be copied to the public dir and will be available to use in twig templates.
###Working with CSS
We have Bootstrap 4 pre-installed. Place your css or sass inside assets/css - directly in app.scss, or in separate .scss files thar are imported into app.scss. The css is compiled with the commands npm run dev, or npm run watch. The second one monitors the files for changes and re-compiles continuosly - useful during development. Due to the fact that we are using Webpack Encore and we have enabled AutoPrefixer - there is no need to write prefixes inside the css/scss files. All the needed prefixes will be added automatically during compilation time.
###Writing JavaScript
All JS resides in the assets/js dir. The project is setup using Symfony's Webpack Encore bundle. Webpack's configuration resides in /webpack.config.js. Main entry point for the JS is /assets/js/app.js.
The project uses Vue.JS, Stimulus.js as well as jQuery - mostly for working with AJAX requests.
When writing Vue component, add them to the /assets/js/components dir, or to the /assets/js/infrastructure dir - if they are generic in purpose (like a modal, or a tab). Do not forget to import them inside app.js so that they are compiled and available.
When writing Stimulus controllers, place them inside /assets/js/controllers. We use these types of controllers for simple pieces of functionality - that usually don't require rendering html via JS, that must be reused in different places around the app. Stimulus controllers are automatically included inside app.s - as long as they are placed in the above mentioned dir.
All ECMAScript 2015 (JS6) language features are available. Working with JS is similar to working with css. Run npm run watch so that the new code is auto-compiled on the go.
###Working with Docker
It is possible (not necessary) to create your database inside a Docker container. For example, if your local XAMPP version has a lower MySQL version and you don't want to update XAMPP. There is docker-compose.yml file at project root level. Install Docker (there is GUI application available) on your machine and then run docker-compose up. Or docker-compose up -d (to run the container as daemon).
###Working with Symfony local web server
It is an option to use the new Symfony local web server instead of Apache or Nginx. This may be an option if your XAMPP version uses PHP version < 7.3 and you don't want to update it. For details, take a look here: https://symfony.com/doc/current/setup/symfony_server.html.
