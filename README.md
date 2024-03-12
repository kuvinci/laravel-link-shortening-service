# Laravel Link Shortening Service
## Overview
This project is developed to offer a basic yet powerful link shortening service, built on Laravel 10.x using PHP 8.1. It allows users to create shortened URLs with optional features like redirect limits and expiration times.

## Key areas to focus on:
- *app*
    - *Console*
        - [**Kernel.php**](https://github.com/kuvinci/laravel-link-shortening-service/blob/master/app/Console/Kernel.php) (For scheduling the cleanup of expired links)
    - *Http*
        - *Controllers*
            - [**LinkController.php**](https://github.com/kuvinci/laravel-link-shortening-service/blob/master/app/Http/Controllers/LinkController.php) (Handles the core logic for link creation, redirection, and management)
    - *Models*
        - [**Link.php**](https://github.com/kuvinci/laravel-link-shortening-service/blob/master/app/Models/Link.php) (The model representing the links in the database)
- *database*
    - *migrations*
        - [**all relevant migrations**](https://github.com/kuvinci/laravel-link-shortening-service/tree/master/database/migrations) (For creating and updating the links table with necessary columns like `expires_at`, `access_count`, etc.)
    - *seeders*
        - [**DatabaseSeeder.php**](https://github.com/kuvinci/laravel-link-shortening-service/blob/master/database/seeders/DatabaseSeeder.php) (For seeding the database with initial data if necessary)
- *routes*
    - [**web.php**](https://github.com/kuvinci/laravel-link-shortening-service/blob/master/routes/web.php) (Defines the routes for creating and accessing shortened links)
- *resources*
    - *views*
        - [**link/index.blade.php**](https://github.com/kuvinci/laravel-link-shortening-service/blob/master/resources/views/link/index.blade.php) (The main view for creating shortened links)
        - [**links/expired.blade.php**](https://github.com/kuvinci/laravel-link-shortening-service/blob/master/resources/views/links/expired.blade.php) and [**links/limit_reached.blade.php**](https://github.com/kuvinci/laravel-link-shortening-service/blob/master/resources/views/links/limit_reached.blade.php) (Views for showing expired link and limit reached messages)
- *tests*
    - *Feature*
        - [**LinkCreationTest.php**](https://github.com/kuvinci/laravel-link-shortening-service/blob/master/tests/Feature/LinkCreationTest.php) (Tests for link creation functionality)
        - [**LinkRedirectionTest.php**](https://github.com/kuvinci/laravel-link-shortening-service/blob/master/tests/Feature/LinkRedirectionTest.php) (Tests for link redirection logic)

## Setup
- Clone this repository.
- Run `composer install`.
- Copy `.env.example` to `.env` and configure your environment settings, including database and cache.
- Run `php artisan key:generate` to generate the application key.
- Run `php artisan migrate` to set up your database schema.
- Start the application using Laravel's built-in server with `php artisan serve`, or use Laravel Sail with `./vendor/bin/sail up`.
- Access the Laravel application at `http://localhost`.
- Run `php artisan schedule:run` manually or configure a Cron job to execute it every minute for the scheduled tasks.
- Run `php artisan test` to run tests.

This project is aimed at demonstrating basic Laravel functionalities along with specific features like link shortening with expiration and access limits. It's a perfect starting point for learning and experimentation with Laravel.
