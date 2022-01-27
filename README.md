# UnknownRori PHP (WIP)

## Table of Contents

- Overview

- Lifecycle Overview

    - HTTP Request Lifecycle

        - First Step

        - Kernel

        - HTTP Request & Route

        - Finishing


- Installation

    - Requirement

        - Minimum

        - Recommended

        - Tested Database

    - Dependency

- Usage

- Roadmap

- Note

# Overview

`Rori-PHP` is custom non production web application framework with inspired with [Laravel](https://laravel.com/) syntax. A web framework provides a structure  and starting point for your application allowing you to focus on creating something amazing.

`Rori-PHP` also come with `CLI`, type in terminal `python3 .` it will bring out `UnknownRori CLI`

# Lifecycle Overview

## Request Lifecycle

### First Step

The entry point for all request to Rori-PHP Application is in public/index.php, this file does not have a lot of code, but rather loading starting point for framework. file will load server.php, and the server.php will load composer autoload.php and bootstrap.php in app and `Core` directory.

### Kernel

Next, the incoming request will be sent to `Core\Kernel` to check http request is requesting a web page or a resource.

### HTTP Request & Route

Next, the request will be sent to Route to depending on type of the request, these Route serve as central location that all request will flow through, `Runtime Middleware` will be fired via `Core\Http\Middleware\Middleware` if the request is not a resource, if the request available in Routing, then `Core\Http\Route\Route` will fired the Controller Method.

### Finishing
Lastly, after the client get the response the `Runtime Middleware` will fired for the second time, and we finished the request lifecycle!
### WIP


# Installation

- Clone this repository.
- enter the cloned directory.
- run `composer install`
- run `composer dump-autoload`.
- create something amazing

---

### Requirement

> #### Minimum

- `PHP : 8`.
- `Dependecy Manager : Composer`.
- `Database : Yes`.

> #### Recommended

- `Python : 3 (For CLI)`.

> #### Tested Database

- `Mysql`
- `Sqlite`

---
### Dependency

- `vlucas/phpdotenv`.

# Usage

## WIP

# Roadmap

## WIP

# Note


`Q : Why you create this custom non production framework?`

`A : Because i want to polish my backend skill, documentation making, decision making, and of course code efficiency.`

---

`Q : Is this can be used in production.`

`A : Short answer no, Why? because i cannot guarantee the security, unless you modify some of the source code.`