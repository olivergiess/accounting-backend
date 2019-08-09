# accounting-api

Simple Accounting API built with Laravel 5.8 with the intention of exercising new (Laravel) features, paradigms and patterns.

## Getting Started

These instructions will get you a copy of the project up and running on your local machine for development and testing purposes. See deployment for notes on how to deploy the project on a live system.

### Prerequisites

What things you need to install the software and how to install them

```
composer
```

### Installing

Once you have a copy of the project locally with PHP 7.1.3+ and DB of your choice installed follow the below steps.

1. Configure .env file, to do so you can copy the .env.example or rename it and fill out the fields as per a normal Laravel 5.8 installation (we will cover generating the application key in step 3).

2. Install dependencies

```
composer install
```

3. Generate Application Key. 

```
php artisan key:generate
```

4. Run database migrations, this will setup the tables for our application.

```
php artisan migrate
```

5. Generates keys for Laravel Passports OAuth implementation.

```
php artisan passport:install
```

## Running the tests

This project utilizes PHPUnit for Unit Testing, you can use the below command to validate the project is functioning correctly.

```
phpunit
```

## Deployment

Deployment steps as per Installation.

## Built With

* [Laravel](https://github.com/laravel/laravel) - MVC Framework
* [Passport](https://github.com/laravel/passport) - OAuth 2.0 Implementation
* [Laravel-CORS](https://github.com/barryvdh/laravel-cors) - Applies CORS Headers to requests

## Authors

* **Oliver Giess** - *Initial work* - [olivergiess](https://github.com/olivergiess)

