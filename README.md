## Coding Challenge Solution

This is a webapp I made mostly using Laravel 8 and Vue 3

## Tech stack
- Laravel
- Vue 3
- Pinia
- Tailwindcss (to build something clean it has to look clean lol)

## Features 
- Fetching products
- Creating products
- Filtering products and sorting them by price

## Requirements

	PHP >= 7.4
	Node >= 16

## Install

Clone repo

```
git clone https://github.com/chenten16/coding-challenge-solution.git
```

Install Composer


[Download Composer](https://getcomposer.org/download/)


composer update/install 

```
composer install
```

Install Nodejs


[Download Node.js](https://nodejs.org/en/download/)


NPM dependencies
```
npm install
```

Using Laravel Mix 

```
npm run dev
```

## How to setting 

Go into .env file and change Database 

```
php artisan migrate
```

```
php artisan db:seed
```
	
Generating a New Application Key
```
php artisan key:generate
```
## Commands
To create product using cli run this command:

```
php artisan products:create
```


