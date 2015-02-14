bdgt
====

## Big finance tools in a small package

bdgt is a one-stop personal finance management app. Planned features:  

- Zero-based bugeting system
- Bill management, calendar, and reminders
- Account management/transaction history
- Goal system with automatic monthly budgeting
- Forecasting (net worth/account balance)
- Debt and savings calculators
- Interactive reports

## Screenshots

![screenshot: bills page](http://puu.sh/fUYT7/a9d80cd65e.png)

![screenshot: goals page](http://puu.sh/fUYGh/c9e4c2e4bc.png)

## Installation

`cp .env.example .env`  
`vagrant up` -- requires [Vagrant](https://www.vagrantup.com/)  
`composer install` -- requires [Composer](https://getcomposer.org/)  
`php artisan migrate:install`  
`php artisan migrate:refresh --seed`