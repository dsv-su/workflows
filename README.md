## 1. Overview
Development setup for DSV Workflows test

## 2. Requirements
Requirements are best determined using Server Requirements page of corresponding Laravel 8 version

- PHP version 7.4.*

- BCMath PHP Extension

- Ctype PHP Extension

- Fileinfo PHP extension

- JSON PHP Extension

- Mbstring PHP Extension

- OpenSSL PHP Extension

- PDO PHP Extension

- Tokenizer PHP Extension

- XML PHP Extension

- SSH access to the server

- Composer

## 3. Installation

* Make sure that composer is installed globally or install it in place

    * Clone the repository


* Make sure the subdirectories
  `bootstrap/cache` and `/storage` is writable by your web server user.

Make sure these folder exist or create these folders under storage/framework:

    sessions 
    views
    cache

* Once the global settings are entered you can install the dependencies. `composer install`

    * Make sure that .env file is present (copy .env.example to .env). If you are setting up a dev enviroment add the following settings to the .env file:
    
    LOG_CHANNEL=daily

    QUEUE_CONNECTION=database
