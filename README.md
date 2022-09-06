
## Introduction
* Test application for Emerchantpay.
* Used technologies Slim Framework 3 https://www.slimframework.com/docs/v3/ and React https://reactjs.org/ with React bootstrap https://react-bootstrap.github.io/

## Features
* Add Post,
* Edit post
* Login
* API for posts
* List posts

## Installation

Prerequisites
* Docker installed on the machine
* npm

Clone the repository

    git clone https://github.com/vrosen/emerchantpay.git

Go to src directory and run 

    composer install

Go to front directory and run

    yarn install

To build and start API web server go to the root of the project where the docker-compose.yml file is located and run

    docker-compose up --build

To start the front end React application go to the front directory and run

    yarn start

The web server should be available on http://localhost:8000

The front end client part should be available on http://localhost:3000

For convenience there is phpmyadmin mysql client serving on http://localhost:8081

All endpoints of the API are described on http://localhost:8000

## Short description
As my first time using Slim Framework 3, I completely relied on its documentation which can be found here https://www.slimframework.com/docs/v3/

All the code is written by myself, no copy-pasted fragments except part of external libraries

Migrations and Seeders are not presented due to bad compatability of libraries of the framework and those needed for the https://phinx.org/, there is database which is being imported on docker compose runtime

No unit test presented too, it needed great deal of modification in order to meet the requirements for the project and not enough time for this, it must be downloaded in the docker container and run from it

No swagger presented due to library incompatibilities

List of posts which can be seen by all users.
* If user has admin rights, represented as a boolean value in the database, can see two more links in the header, to make a new post and to go to the admin section.The admin section has a list of all posts where admin can edit each one of them.
* In the database are two users with admin and non-admin rights:

        admin: admin@email.com / qwerty
        user: user@email.com / qwerty

* There is web client part, where the API points are described, the reason for this is to be shown the separation of the views and the models and controllers on a framework level
* There is basic validations presented for the GET requests, reason is to present middleware functionality
* Authentication for some requests, presented by middleware again, used JWT token library for it
* Resource classes presented as a response data modifiers in order to meet the JSON data format
* All routes are described in routes/routes.php file
* Configuration file can be found under config/config.php
* Bootstrapping the basics of the app is under app/bootstrap.php
* Models are represented as classes responsible for the database queries for its corresponding database tables.For each such class there is entity class which converts the queried data into object of its kind.
* Used services to accumulate all data logic for requests transferred from the controllers

* the React application is very simple and basic
* no validations for the images on upload. Validation for image type and size should be added in react part as well in the backend part.
* current version of **PHP** and all **installed modules** are described in the Dockerfile in the root directory of the project.
* Current version is 7.4 with Apache
