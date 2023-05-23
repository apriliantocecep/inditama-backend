## About this repository

This is backend test for INDITAMA

## Installation

- Clone this project
- cd path/to/your/project
- composer install
- cp .env.example .env
- make some changes in .env file. like: database settings and APP_URL
- php artisan key:generate
- php artisan migrate:fresh --seed

## Configuration

Make some changes in the `.env` file

### JWT 

run command `php artisan jwt:secret`

```
JWT_SECRET={generated from command}
```

### Filesystem

Public filesystem

```
FILESYSTEM_DISK=public
```

### Database

Adjust database env with your own setting

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=inditama
DB_USERNAME=root
DB_PASSWORD=
```

### App Url

Adjust the application url, if you are using artisan `serve`, use this url

```
APP_URL=http://localhost:8000
```

## Run

Run this application using `serve` or other method (like valet or homestead)

```
$ php artisan serve
```

## API Documentation

Download postman collection in this repo

## Credential

Every user generated using seeder, will using `password` for login.