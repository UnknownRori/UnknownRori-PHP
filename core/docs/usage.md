# Usage Documentation(WIP)

## Table of Content

- The Basic

  - Routing

    - Default Route Files

  - Middleware

    - Introduction

  - Controller

  - Views

  - Session

- Digging Deeper

  - CLI

  - Collection

  - File Storage

- Security

  - Authentication

  - Hashing

- Database

  - Overview

  - Query

  - Prepared Statement

  - Pre-Defined Database Function

# The Basic

## Routing

The most basic UnknownRori-PHP route is accept URI and Controller Class and it's method, very simple and OOP behavior without complicated configuration.

`$route->get('/', [Home::class, 'index']);`

### Default Route Files

All UnknownRori-PHP routes are defined in route file, which is located in `app/route` directory, these file automatically loaded by `Core\Kernel`, the `app/route/web.php` file defines routes that are for your web interface. These routes can be assigned to the middleware.

For most application, you will begin by defining routes inside `app/route/web.php` file, these defined route URL can be accessed using your browser, for example `localhost:8080/user` in your browser

`$route->get('/user', [User::class, 'index']);`

The router allows you to register routes that respond to any HTTP verb

`$route->get('/', [ControllerName::class, 'method']);`
`$route->post('/', [ControllerName::class, 'method']);`
`$route->delete('/', [ControllerName::class, 'method']);`
`$route->patch('/', [ControllerName::class, 'method']);`
