bdgt
====

![build status](https://img.shields.io/github/workflow/status/sbine/bdgt/PHP%20tests)

## Big finance tools in a small package

bdgt is a one-stop personal finance management app. Planned features:  

- Zero-based budgeting system
- Bill management, calendar, and reminders
- Account management/transaction history
- Goal system with automatic monthly budgeting
- Forecasting (net worth/account balance)
- Debt and savings calculators
- Interactive reports

> **Demo at [https://bdgt.it](https://bdgt.it)**  
> `admin@example.com` / `admin`

## Index

- [Screenshots](#screenshots)
- [Installation](#installation)
  - [Using PHP on your machine](#using-php-on-your-machine)
  - [Using Docker (Laravel Sail)](#using-docker-laravel-sail)
- [Building the frontend assets](#building-the-frontend-assets)

## Screenshots

![screenshot: bills page](https://sarabine.com/bdgt-bills.png)

![screenshot: goals page](https://sarabine.com/bdgt-goals.png)

![screenshot: reports](https://sarabine.com/bdgt-reports.png)

## Installation

### Using PHP on your machine

This project requires PHP 7.4+, a MySQL database, [Composer](https://getcomposer.org/), and [NPM](https://www.npmjs.com/).

If you already have PHP installed, you can use `php artisan serve` or [Laravel Valet](https://laravel.com/docs/valet) paired with an installed version of MySQL, or a tool like [Takeout](https://github.com/tighten/takeout).

<details>
<summary>Click to expand local setup instructions</summary>

Run these commands to install dependencies and configure the app:

```bash
cp .env.example .env # edit the values in .env to suit your environment
composer install
php artisan key:generate
php artisan migrate
php artisan db:seed
npm install
npm run dev
```

A dummy account will be created with the following credentials which can be used to log in and preview the app:  
Email: admin@example.com  
Password: admin
</details>

### Using Docker (Laravel Sail)

A Docker config is provided with all required dependencies using [Laravel Sail](https://laravel.com/docs/sail).

<details>
<summary>Click to expand Docker instructions</summary>

1. Copy the .env file and edit the values to suit your environment:

   ```bash
   cp .env.example .env
   ```
2. If you have Composer installed, run `composer install` to install Laravel Sail. Otherwise, install using the following Docker command (see [the docs](https://laravel.com/docs/8.x/sail#installing-composer-dependencies-for-existing-projects)):
   ```bash
   docker run --rm \
       -v $(pwd):/opt \
       -w /opt \
       laravelsail/php80-composer:latest \
       composer install
   ```

3. Start the containers:

   ```bash
   # Add -d to run in the background
   ./vendor/bin/sail up
   ```

4. Configure the app and build the frontend:

   ```bash
   ./vendor/bin/sail artisan key:generate
   ./vendor/bin/sail artisan migrate
   ./vendor/bin/sail artisan db:seed
   ./vendor/bin/sail npm install
   ./vendor/bin/sail npm run dev
   ```

The app will be available on http://localhost:[APP_PORT], depending on the `APP_PORT` you specified in your .env file (`80` by default).

A dummy account will be created with the following credentials which can be used to log in and preview the app:  
Email: admin@example.com  
Password: admin
</details>

## Building the frontend assets
If you make changes to JS or SCSS files, you'll need to recompile the frontend assets.

`npm run watch` — to automatically compile changes  
