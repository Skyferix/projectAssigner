# ProjectAssigner

## Simple project management app.

This app build using php framework Symfony.
Whole app works on MVC (Modal View Controller) principle.

## Table of content
- [Technologies](#Technologies)
- [Setup](#Setup)
- [Server](#Server)
- [Database](#Database)
- [Start](#Enter)
- [Testing](#Testing)


## Technologies

- To build database structure and interact with records as objects way App used "[Databases and the Doctrine ORM](https://symfony.com/doc/current/doctrine.html)".

- To test app functionality used "[The PHPUnit Testing Framework](https://symfony.com/doc/current/testing.html)".

- To manage TypeScript, Javascript and CSS files for dizain purposes used "[Webpack Encore](https://symfony.com/doc/current/frontend.html)".

- To redirect user to the needed url created service for [kernel.event.listener](https://symfony.com/doc/current/event_dispatcher.html) to listen to the request and redirect when needed.

- App also uses some async requests ([AJAX](https://api.jquery.com/jquery.ajax/)) to make some content changes without reloading the page.
- For testing used: [dama/doctrine-test-bundle](https://packagist.org/packages/dama/doctrine-test-bundle) to revert changes made to database after every test.

- Other technologies used in project [Bootsrap](https://getbootstrap.com/).

## Setup

Download

- [composer](https://getcomposer.org/) - PHP package manager!
- [node.js](https://nodejs.org/) - Npm package manager!

Run commands
```sh
composer update
npm i
npm run build
```

## Server
To start server use
```sh
symfony server:start
```

## Database

Current app is setuped to work on localhost address wich can be changed is .evv file.


## Start
To start using the local web server go to

```sh
https://127.0.0.1:8000/
```
 or
 ```sh
 https://localhost:8000/
```

## Testing

For testing used purpsoses created separate database.

> **NOTE:**
I tried run sqli database from memory for testing purposes but run into records creating problem.
>
To run test run command 
 ```sh
symfony php bin/phpunit tests/StudentTest.php
```
