bdgt
====

## Big finance tools in a small package

bdgt is a one-stop personal finance management app. Planned features:  

- Zero-based budgeting system
- Bill management, calendar, and reminders
- Account management/transaction history
- Goal system with automatic monthly budgeting
- Forecasting (net worth/account balance)
- Debt and savings calculators
- Interactive reports

## Screenshots

![screenshot: bills page](https://sarabine.com/bdgt-bills.png)

![screenshot: goals page](https://sarabine.com/bdgt-goals.png)

![screenshot: reports](https://sarabine.com/bdgt-reports.png)

## Installation

`cp .env.example .env`  
`vagrant up` -- requires [Vagrant](https://www.vagrantup.com/)  
`composer install` -- requires [Composer](https://getcomposer.org/)  
`php artisan migrate:install`  
`php artisan migrate:refresh --seed`

A dummy account will be created with the following credentials which can be used to login and preview the app:  
Email: admin@example.com  
Password: admin
