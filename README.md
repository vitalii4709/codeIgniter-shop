# Build a E-Shop App with CodeIgniter 4 

This is the code repo for the E-Shop App with CodeIgniter 4 .

## Server Requirements

PHP version 7.4 or higher is required, with the following extensions installed:

- [intl](http://php.net/manual/en/intl.requirements.php)
- [mbstring](http://php.net/manual/en/mbstring.installation.php)

Additionally, make sure that the following extensions are enabled in your PHP:

- json (enabled by default - don't turn it off)
- [mysqlnd](http://php.net/manual/en/mysqlnd.install.php) if you plan to use MySQL
- [libcurl](http://php.net/manual/en/curl.requirements.php) if you plan to use the HTTP\CURLRequest library


## Installation

- Clone the repo: `git clone https://github.com/vitalii4709/codeIgniter-shop.git`
- Go into the repo: `cd codeIgniter-shop` then `composer update`
- When updating, check the release notes to see if there are any changes you might need to apply
    to your `app` folder. The affected files can be copied or merged from
    `vendor/codeigniter4/framework/app`.
- Copy `env` to `.env` and tailor for your app, specifically the baseURL and any database settings.
- Create a database named `styletour` to use MySQL
- Import `styletour.sql` database dump into MySQL
- Set up a mail server `app/config/mail.php` if you will send email
- Start local web server 
- Visit the app: <http://styletour.loc>
- Visit the app: <http://styletour.loc/admin> `email: user@mail.com`, `password: 111111`

## What is CodeIgniter?

CodeIgniter is a PHP full-stack web framework that is light, fast, flexible and secure.
More information can be found at the [official site](https://codeigniter.com).

## Important Change with index.php

`index.php` is no longer in the root of the project! It has been moved inside the *public* folder,
for better security and separation of components.

This means that you should configure your web server to "point" to your project's *public* folder, and
not to the project root. A better practice would be to configure a virtual host to point there. A poor practice would be to point your web server to the project root and expect to enter *public/...*, as the rest of your logic and the framework are exposed.

**Please** read the user guide for a better explanation of how CI4 works!




