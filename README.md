# UnknownRori PHP

[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](https://opensource.org/licenses/MIT)
[![](https://tokei.rs/b1/github/UnknownRori/UnknownRori-PHP)](https://github.com/XAMPPRocky/tokei)
![GitHub repo size](https://img.shields.io/github/repo-size/UnknownRori/UnknownRori-PHP)

## Table of Contents

- [Overview](https://github.com/UnknownRori/UnknownRori-PHP#overview)

- [Request Lifecycle Overview](https://github.com/UnknownRori/UnknownRori-PHP#request-lifecycle-overview)

  - [First Step](https://github.com/UnknownRori/UnknownRori-PHP#first-step)

  - [Kernel](https://github.com/UnknownRori/UnknownRori-PHP#kernel)

  - [HTTP Request & Route](https://github.com/UnknownRori/UnknownRori-PHP#http-request--route)

  - [Finishing](https://github.com/UnknownRori/UnknownRori-PHP#finishing)

- [Installation](https://github.com/UnknownRori/UnknownRori-PHP#installation)

  - [Requirement](https://github.com/UnknownRori/UnknownRori-PHP#requirement)

    - [Minimum](https://github.com/UnknownRori/UnknownRori-PHP#minimum)

    - [Recommended](https://github.com/UnknownRori/UnknownRori-PHP#recommended)

    - [Tested Database](https://github.com/UnknownRori/UnknownRori-PHP#tested-database)

  - [Dependency](https://github.com/UnknownRori/UnknownRori-PHP#dependency)

- [Usage](https://github.com/UnknownRori/UnknownRori-PHP#usage)

- [Roadmap](https://github.com/UnknownRori/UnknownRori-PHP#roadmap)

- [Note](https://github.com/UnknownRori/UnknownRori-PHP#note)

# Overview

`Rori-PHP` is custom non production web application framework inspired by [Laravel](https://laravel.com/) syntax and elegantness. A web framework provides a structure  and starting point for your application allowing you to focus on creating something amazing.

`Rori-PHP` also come with `CLI`, type in terminal `php cli`.

# Request Lifecycle Overview

## First Step

The entry point for all request to Rori-PHP Application is in public/index.php, this file does not contain a lot of code, but rather loading a starting point for framework. this file will load server.php to load composer autoload.php and bootstrap.php in `app`, `core` and `vendor` directory.

## Kernel

Next, the incoming request will be sent to `Core\Kernel` to check http request is requesting a web page or a resource.

## HTTP Request & Route

Next, the request will be sent to Route to depending on type of the request, these Route serve as central location that all request will flow through, `Runtime Middleware` will be fired via `Core\Support\Http\Middleware` if the request is not a resource, if the request available in Routing, then `Core\Support\Http\Route` will fired the Controller Method.

## Finishing

Lastly, after the client get the response the `Runtime Middleware` will fired for the second time, and we finished the request lifecycle!

# Installation

- Enter the release page in this repository.
- Download the latest version.
- enter the downloaded folder.
- run `composer install`
- run `composer dump-autoload`.
- create something amazing!

Or using Composer

`composer create-project unknownrori/unknownrori-php`

Note : Master branch in this repository is used for development do not use this version for development of new website or something.

---

### Requirement

> #### Minimum

- `PHP : 7.4`.
- `Composer`.

> #### Recommended

- `PHP : 8+`.
- `Npm`
- `Database : Yes`.

> #### Tested Database

- `Mysql`
- `Sqlite`

---

### Dependency

- `vlucas/phpdotenv`.
- `symfony/var-dumper`.
- `eftec/bladeone`

# Usage

For usage please read [this](https://github.com/UnknownRori/UnknownRori-PHP/blob/master/core/docs/usage.md) for more information, Or you can use the local documentation inside the `Core/docs/usage.md`.

# Roadmap

- ~~Basic CLI~~
- ~~Basic Route~~
- ~~Simple Controller~~
- ~~Middleware~~
- ~~Basic Database~~
- ~~Basic Framework Custom Exception~~
- ~~Namespace Overhaul~~
- ~~Session~~
- ~~Cookie~~
- ~~Cache~~
- ~~CLI Overhaul~~
- ~~Pre-defined Database Function~~
- ~~Collection~~
- ~~Model~~
- ~~User Authentication~~
- ~~Storage~~
- ~~Model Overhaul~~
- ~~Middleware Group~~
- ~~Route prefix name~~

# Note

`Q : Why you create this custom non production framework?`

`A : Because i want to polish my backend skill, documentation making, decision making, and of course code efficiency.`

---

`Q : Is this can be used in production.`

`A : You can use it, but i cannot guarantee the security.`

---

`Q : Can i use this for future my project?`

`A : Yea sure, if something goes wrong you can create issues, feedback encouraged.`

---

`Q : The framework name is so funny`

`A : Yea i am out of name idea.`
