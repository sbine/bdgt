bdgt
====

![build status](https://img.shields.io/github/workflow/status/sbine/bdgt/Run%20tests)

## Big finance tools in a small package

bdgt is a one-stop personal finance management app. Planned features:  

- Zero-based budgeting system
- Bill management, calendar, and reminders
- Account management/transaction history
- Goal system with automatic monthly budgeting
- Forecasting (net worth/account balance)
- Debt and savings calculators
- Interactive reports

## Demo

A demo application is available at [https://bdgt.it](https://bdgt.it)

## Screenshots

![screenshot: bills page](https://sarabine.com/bdgt-bills.png)

![screenshot: goals page](https://sarabine.com/bdgt-goals.png)

![screenshot: reports](https://sarabine.com/bdgt-reports.png)

## Installation

This project requires a PHP environment and a MySQL database.  
For local development you can use PHP on your host machine (`php artisan serve`), [Laravel Valet](https://laravel.com/docs/master/valet), or [Laravel Homestead](https://laravel.com/docs/master/homestead).

`cp .env.example .env`  
`composer install` -- requires [Composer](https://getcomposer.org/)  
`php artisan key:generate`  
`php artisan migrate`  
`php artisan db:seed`

A dummy account will be created with the following credentials which can be used to login and preview the app:  
Email: admin@example.com  
Password: admin

### Building the frontend assets
If you make changes to JS or SCSS files, you'll need to recompile the frontend assets.

`npm install` -- requires [NPM](https://www.npmjs.com/)  
`npm run watch` -- to automatically compile changes  
`npm run prod` -- before submitting a PR  
