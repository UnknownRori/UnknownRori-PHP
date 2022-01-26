# UnknownRori PHP (WIP)

## Table of Contents

- Overview

- Lifecycle Overview

    - HTTP Request Lifecycle

        - First Step

        - Kernel

        - HTTP Request & Route

        - Finishing

    - Console Lifecycle (WIP)


- Installation

- Usage

- Roadmap

- Note

# Overview

Rori-PHP is custom non production PHP framework that can be used on school project or personal project, this framework will try it's best to give laravel like function feature and security.

# Lifecycle Overview

## Request Lifecycle


### First Step

The entry point for all request to Rori-PHP Application is in public/index.php, this file does not have a lot of code, but rather loading starting point for framework. file will load server.php, and the server.php will load composer autoload.php and bootstrap.php in app and core(framework) directory.

### Kernel

Next, the incoming request will be sent to `Core\Kernel` to check http request is requesting a web page or a resource.

### HTTP Request & Route

Next, the request will be sent to Route to depending on type of the request, these Route serve as central location that all request will flow through, whether registered Routing or not the `Runtime Middleware` will be fired via `Core\Http\Middleware\Middleware`, if the request available in Routing it will then check the Controller and the Method of the Routing after checking the Router will fired the Controller Method

### Finishing

### WIP


# Installation

## WIP

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