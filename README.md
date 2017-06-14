# Introduction

Creditoo Test is an app build with Laravel 5.4 that show your Github profile.

## Demo

[https://creditoo-test.herokuapp.com/](https://creditoo-test.herokuapp.com/)

## Server Requirements

- PHP >= 5.6.4
- OpenSSL PHP Extension
- PDO PHP Extension
- Mbstring PHP Extension
- Tokenizer PHP Extension
- XML PHP Extension

## Installation

1. Clone the repository

```
$ git clone https://github.com/hideks/hiring.git
```

2. Go into the repository

```
$ cd hiring
```

3. Rename ".env.example" to ".env"

4. Open .env and configure DB and GITHUB sections

5. Install the dependencies

```
$ composer install
```

6. Migrate database

```
$ php artisan migrate
```

7. Clear cache to prevent errors (repeat this step every time you update .env file)
```
$ php artisan cache:clear && composer dump-autoload
```

8. Run

```
$ php artisan serve
```

9. Now you can point your browser to http://localhost:8000 and see the application working.