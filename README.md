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
        - [**Links Migration**](https://github.com/kuvinci/laravel-link-shortening-service/blob/main/database/migrations/2024_03_12_141113_create_links_table.php) (For creating and updating the links table with necessary columns like `expires_at`, `access_count`, etc.)
- *routes*
    - [**web.php**](https://github.com/kuvinci/laravel-link-shortening-service/blob/master/routes/web.php) (Defines the routes for creating and accessing shortened links)
- *resources*
    - *views*
        - [**index.blade.php**](https://github.com/kuvinci/laravel-link-shortening-service/blob/main/resources/views/index.blade.php) (The main view for creating shortened links)
        - [**404.blade.php**](https://github.com/kuvinci/laravel-link-shortening-service/blob/main/resources/views/404.blade.php)

## Setup
```bash
./vendor/bin/sail up
 ```
```bash
./vendor/bin/sail artisan migrate
 ```

-> http://localhost
