`Docs Version : 2.0 Alpha`

# Usage Documentation

## Table of Content

- [The Basic](https://github.com/UnknownRori/UnknownRori-PHP/blob/master/core/docs/usage.md#the-basic)

  - [Routing](https://github.com/UnknownRori/UnknownRori-PHP/blob/master/core/docs/usage.md#routing)

    - [Default Route Files](https://github.com/UnknownRori/UnknownRori-PHP/blob/master/core/docs/usage.md#default-route-files)

    - [Route Name prefix](https://github.com/UnknownRori/UnknownRori-PHP/blob/master/core/docs/usage.md#route-name-prefix)

      - [Generating URI to Named Routes](https://github.com/UnknownRori/UnknownRori-PHP/blob/master/core/docs/usage.md#generating-uri-to-named-routes)

    - [Route Group](https://github.com/UnknownRori/UnknownRori-PHP/blob/master/core/docs/usage.md#route-group)

      - [Middleware](https://github.com/UnknownRori/UnknownRori-PHP/blob/master/core/docs/usage.md#middleware)

      - [Prefix](https://github.com/UnknownRori/UnknownRori-PHP/blob/master/core/docs/usage.md#prefix)

      - [Name Prefix](https://github.com/UnknownRori/UnknownRori-PHP/blob/master/core/docs/usage.md#name-prefix)

      - [Chaining the Group](https://github.com/UnknownRori/UnknownRori-PHP/blob/master/core/docs/usage.md#chaining-the-group)

  - [Middleware](https://github.com/UnknownRori/UnknownRori-PHP/blob/master/core/docs/usage.md#middleware-1)

    - [Introduction](https://github.com/UnknownRori/UnknownRori-PHP/blob/master/core/docs/usage.md#introduction)

    - [Defining Middleware](https://github.com/UnknownRori/UnknownRori-PHP/blob/master/core/docs/usage.md#defining-middleware)

    - [Global Middleware](https://github.com/UnknownRori/UnknownRori-PHP/blob/master/core/docs/usage.md#global-middleware)

    - [Assigning Middleware to Routes](https://github.com/UnknownRori/UnknownRori-PHP/blob/master/core/docs/usage.md#assigning-middleware-to-routes)

  - [CSRF Protection](https://github.com/UnknownRori/UnknownRori-PHP/blob/master/core/docs/usage.md#csrf-protection)

    - [Introduction](https://github.com/UnknownRori/UnknownRori-PHP/blob/master/core/docs/usage.md#introduction-1)

    - [Preventing CSRF Requests](https://github.com/UnknownRori/UnknownRori-PHP/blob/master/core/docs/usage.md#preventing-csrf-requests)

  - [Controller](https://github.com/UnknownRori/UnknownRori-PHP/blob/master/core/docs/usage.md#controller)

    - [Introduction](https://github.com/UnknownRori/UnknownRori-PHP/blob/master/core/docs/usage.md#introduction-2)

    - [Writing Controller](https://github.com/UnknownRori/UnknownRori-PHP/blob/master/core/docs/usage.md#writing-controller)

    - [Route Resource](https://github.com/UnknownRori/UnknownRori-PHP/blob/master/core/docs/usage.md#route-resource)

  - [Response](https://github.com/UnknownRori/UnknownRori-PHP/blob/master/core/docs/usage.md#response)

    - [Introduction](https://github.com/UnknownRori/UnknownRori-PHP/blob/master/core/docs/usage.md#introduction-3)

    - [Creating Response](https://github.com/UnknownRori/UnknownRori-PHP/blob/master/core/docs/usage.md#creating-response)

  - [Validation](https://github.com/UnknownRori/UnknownRori-PHP/blob/master/core/docs/usage.md#validation)

    - [Introduction](https://github.com/UnknownRori/UnknownRori-PHP/blob/master/core/docs/usage.md#introduction-4)

    - [Validator](https://github.com/UnknownRori/UnknownRori-PHP/blob/master/core/docs/usage.md#validator)

    - [Request Validate](https://github.com/UnknownRori/UnknownRori-PHP/blob/master/core/docs/usage.md#request-validate)

  - [Views](https://github.com/UnknownRori/UnknownRori-PHP/blob/master/core/docs/usage.md#views)

    - [Introduction](https://github.com/UnknownRori/UnknownRori-PHP/blob/master/core/docs/usage.md#introduction-5)

    - [Passing Data to Views](https://github.com/UnknownRori/UnknownRori-PHP/blob/master/core/docs/usage.md#passing-data-to-views)

    - [Blade One](https://github.com/UnknownRori/UnknownRori-PHP/blob/master/core/docs/usage.md#blade-one)

  - [Session](https://github.com/UnknownRori/UnknownRori-PHP/blob/master/core/docs/usage.md#session)

    - [Retrieve Data](https://github.com/UnknownRori/UnknownRori-PHP/blob/master/core/docs/usage.md#retrieve-data)

    - [Retrieve All Session Data](https://github.com/UnknownRori/UnknownRori-PHP/blob/master/core/docs/usage.md#retrieve-all-session-data)

    - [Storing Data](https://github.com/UnknownRori/UnknownRori-PHP/blob/master/core/docs/usage.md#storing-data)

    - [Deleting Data](https://github.com/UnknownRori/UnknownRori-PHP/blob/master/core/docs/usage.md#deleting-data)

    - [Destroying Current Session](https://github.com/UnknownRori/UnknownRori-PHP/blob/master/core/docs/usage.md#destroying-current-session)

- [Digging Deeper](https://github.com/UnknownRori/UnknownRori-PHP/blob/master/core/docs/usage.md#digging-deeper)

  - [CLI](https://github.com/UnknownRori/UnknownRori-PHP/blob/master/core/docs/usage.md#cli)

  - [Collection](https://github.com/UnknownRori/UnknownRori-PHP/blob/master/core/docs/usage.md#collection)

    - [Creating Collection](https://github.com/UnknownRori/UnknownRori-PHP/blob/master/core/docs/usage.md#creating-collection)

    - [Available Method](https://github.com/UnknownRori/UnknownRori-PHP/blob/master/core/docs/usage.md#available-method)

  - [Str](https://github.com/UnknownRori/UnknownRori-PHP/blob/master/core/docs/usage.md#str)

    - [Creating Str](https://github.com/UnknownRori/UnknownRori-PHP/blob/master/core/docs/usage.md#creating-str)

    - [Available Method](https://github.com/UnknownRori/UnknownRori-PHP/blob/master/core/docs/usage.md#available-method-1)

  - [File Storage](https://github.com/UnknownRori/UnknownRori-PHP/blob/master/core/docs/usage.md#file-storage)

    - [File](https://github.com/UnknownRori/UnknownRori-PHP/blob/master/core/docs/usage.md#file)

    - [Uploading File](https://github.com/UnknownRori/UnknownRori-PHP/blob/master/core/docs/usage.md#file-uploads)

  - [Cache](https://github.com/UnknownRori/UnknownRori-PHP/blob/master/core/docs/usage.md#cache)

    - [Introduction](https://github.com/UnknownRori/UnknownRori-PHP/blob/master/core/docs/usage.md#introduction-6)

    - [Configuration](https://github.com/UnknownRori/UnknownRori-PHP/blob/master/core/docs/usage.md#configuration)

    - [Cache Usage](https://github.com/UnknownRori/UnknownRori-PHP/blob/master/core/docs/usage.md#cache-usage)

- [Security](https://github.com/UnknownRori/UnknownRori-PHP/blob/master/core/docs/usage.md#security)

  - [Authentication](https://github.com/UnknownRori/UnknownRori-PHP/blob/master/core/docs/usage.md#authentication)

    - [Authenticating Users](https://github.com/UnknownRori/UnknownRori-PHP/blob/master/core/docs/usage.md#authenticating-users)

    - [Protecting Route](https://github.com/UnknownRori/UnknownRori-PHP/blob/master/core/docs/usage.md#protecting-route)

    - [Logging out the users](https://github.com/UnknownRori/UnknownRori-PHP/blob/master/core/docs/usage.md#logging-out-the-users)

  - [Hashing](https://github.com/UnknownRori/UnknownRori-PHP/blob/master/core/docs/usage.md#hashing)

    - [Configuration](https://github.com/UnknownRori/UnknownRori-PHP/blob/master/core/docs/usage.md#configuration-1)

    - [Basic Usage](https://github.com/UnknownRori/UnknownRori-PHP/blob/master/core/docs/usage.md#basic-usage)

    - [Verify](https://github.com/UnknownRori/UnknownRori-PHP/blob/master/core/docs/usage.md#verify)

- [Database](https://github.com/UnknownRori/UnknownRori-PHP/blob/master/core/docs/usage.md#database)

  - [Overview](https://github.com/UnknownRori/UnknownRori-PHP/blob/master/core/docs/usage.md#overview)

  - [Configuration](https://github.com/UnknownRori/UnknownRori-PHP/blob/master/core/docs/usage.md#configuration-2)

  - [Query](https://github.com/UnknownRori/UnknownRori-PHP/blob/master/core/docs/usage.md#query)

    - [Raw Query](https://github.com/UnknownRori/UnknownRori-PHP/blob/master/core/docs/usage.md#raw-query)

    - [Prepared Statement](https://github.com/UnknownRori/UnknownRori-PHP/blob/master/core/docs/usage.md#prepared-statement)

    - [List Method](https://github.com/UnknownRori/UnknownRori-PHP/blob/master/core/docs/usage.md#list-method)

  - [Built in Database Method](https://github.com/UnknownRori/UnknownRori-PHP/blob/master/core/docs/usage.md#built-in-database-method)

    - [Overview](https://github.com/UnknownRori/UnknownRori-PHP/blob/master/core/docs/usage.md#overview-1)

    - [List Method](https://github.com/UnknownRori/UnknownRori-PHP/blob/master/core/docs/usage.md#list-method-1)

  - [Database Collection](https://github.com/UnknownRori/UnknownRori-PHP/blob/master/core/docs/usage.md#database-collection)

  - [Database Model](https://github.com/UnknownRori/UnknownRori-PHP/blob/master/core/docs/usage.md#database-model)

    - [Generating Model Class](https://github.com/UnknownRori/UnknownRori-PHP/blob/master/core/docs/usage.md#generating-model-class)

    - [Table Name](https://github.com/UnknownRori/UnknownRori-PHP/blob/master/core/docs/usage.md#table-name)

    - [Model Relationship](https://github.com/UnknownRori/UnknownRori-PHP/blob/master/core/docs/usage.md#model-relationship)

      - [Defining Relationship](https://github.com/UnknownRori/UnknownRori-PHP/blob/master/core/docs/usage.md#defining-relationship)

        - [Has Many](https://github.com/UnknownRori/UnknownRori-PHP/blob/master/core/docs/usage.md#has-many)

        - [Belongs To](https://github.com/UnknownRori/UnknownRori-PHP/blob/master/core/docs/usage.md#belongs-to)

    - [List Method](https://github.com/UnknownRori/UnknownRori-PHP/blob/master/core/docs/usage.md#list-method-2)

# The Basic

## Routing

The most basic Rori-PHP routes accept a URI and a closure, provide a simple and expressive method of defining routes and behavior without complicated routing configuration files:

```php
Route::get('/', function () {
    return view("welcome");
});
```

Instead of defining all of your request handling logic as closures in your route files, you may wish to organize this behavior using `controller` classes. Controllers can group related request handling logic into a single class. For example, a UserController class might handle all incoming requests related to users, including showing, creating, updating, and deleting users. By default, controllers are stored in the `app/http/controller` directory.

You can define a route to this controller method like so:

```php
Route::get('/', [Home::class, 'index']);
```

### Default Route Files

All UnknownRori-PHP routes are defined in route file, which is located in `app/route` directory, these file automatically loaded by `Core\Kernel`, the `app/route/web.php` file defines routes that are for your web interface. These routes can be assigned to the middleware.

For most application, you will begin by defining routes inside `app/route/web.php` file, these defined route URL can be accessed using your browser, for example `localhost:8080/user` in your browser

```php
Route::get('/user', [User::class, 'index']);
```

The router allows you to register routes that respond to any HTTP verb

```php
Route::get('/', [Welcome::class, 'index']);
Route::post('/', [Welcome::class, 'index']);
Route::delete('/', [Welcome::class, 'index']);
Route::patch('/', [Welcome::class, 'index']);
```

### Route Name prefix

Named routes allow the convenient generation of URI or redirect for specific routes. You may specify a name for route by chaining `name` method onto route definition

```php
Route::get('/user', [UserController::class, 'index'])->name('user');
```

#### Generating URI to Named Routes

Once you assigned a name on given route, you may use the route's name when generating URI or `redirect` helper method

```php
// Generating URI
$uri = Route::getRoute('user', ['id' => 1]);

// Redirect
Route::redirect('user', ['id' => 1]);
```

Or you can use the `route` & `redirect` helper function.

```php
// Generate URI

$uri = route('user', ['id' => 1]);

// Redirect

redirect('user', ['id' => 1]);
```

If the named route defines parameters, you may pass the parameters as the second argument to the route function. The given parameters will automatically be inserted into the generated URL in their correct positions:

```php
$url = route('profile', ['id' => 1]);
```

### Route Group

Route groups allow you to share route attributes, such as middleware across a large number of route without define those attributes on each individual route, Nested group will attempt to merge, middleware and name are appended.

#### Middleware

To assign `middleware` to all route inside the group, you may used `middlewares` method to define `middleware` and the route of the group

You can learn more about `middleware` in the [`middleware`](https://github.com/UnknownRori/UnknownRori-PHP/blob/master/core/docs/usage.md#middleware-1) section

```php
Route::middlewares('test')->group(function () {
    Route::get('/group/1', [Controller::class, 'index']);
    Route::get('/group/2', [Controller::class, 'index']);
});
```

You may also want the route has multiple middleware, you can do this by putting `array` instead of `string` of middleware.

```php
Route::middlewares(['auth', 'verify_token'])->group(function () {
    Route::get('/group/1', [Controller::class, 'index']);
    Route::get('/group/2', [Controller::class, 'index']);
});
```

You may also want to put some of the route has specific middleware than the other you can do this by chaining the route definition with `middleware` method.

```php
Route::middlewares(['auth', 'verify_token'])->group(function () {
    Route::get('/group/1', [Controller::class, 'index']);
    Route::get('/group/2', [Controller::class, 'index'])->middleware('ensureAdmin');
});
```

#### Prefix

To assign same `URI` path inside the group you can use `prefix` method, these method will define the route inside the group to has same `URI` path from group and merged with your current route `URI`

```php
Route::prefix('/auth')->group(function () {
    Route::get('/login', [Controller::class, 'login']);
    Route::post('/logout', [Controller::class, 'logout']);
});
```

From these example above this will intepreted in the route as `domain.com/auth/login` and `domain.com/auth/logout`.

#### Name Prefix

To assign same name in the route group you can use `names` method, these method will add a name before your route `name` definition.

```php
Route::names('auth')->group(function () {
    Route::get('login', [Controller::class, 'login'])->name('login');
    Route::get('logout', [Controller::class, 'logout'])->name('logout');
});
```

On the example above these will intepreted by the route as,
`auth.login` and `auth.logout` route's name.

Note : you must chain individual route definition with `name` method or it will throw an error `name already defined!`.

#### Chaining the group

You also allowed to chain the group before getting initialized by `group` method, and it should still working as expected.

```php
Route::names('auth')->prefix('/auth')->group(function () {
    Route::get('/login', [Controller::class, 'login'])->name('login');
    Route::get('/logout', [Controller::class, 'logout'])->name('logout');
});
```

## Middleware

Middleware provide a convenient mechanism for inspecting and filtering HTTP requests entering your application, Additional middleware can be written to perform a variety of tasks besides authentication, All of these middleware are located in the `app/config/middleware.php`.

### Defining Middleware

To create new middleware, use `make:middleware` cli command

    php cli make:middleware EnsureAdmin

This command will place new `EnsureAdmin` class inside your `app/http/middleware`. In this middleware, we will only allow access the route if the user is authenticate as admin, if the user haven't authenticate it will redirect back to login uri, if already authenticate it will redirect back to home.

```php
<?php

namespace App\Http\Middleware;

use Core\Auth;

class EnsureAdmin
{
    public function Run()
    {
        if (Auth::check()) {
            if (Auth::User()->get('admin')) {
                redirect("dashboard");
            }
        }

        redirect("login");
    }
}
```

As you can see, if the user is not an admin or have not authenticate it will redirect to route that named `login` if the user is an admin it will redirect to route that named `dashboard`.

### Global Middleware

If you want a middleware to run during every http request to your application, you can add it inside `app/config/middleware.php` in this file there are two array will be returned `runtime` and `named`. To add middleware to every http request, you can add it inside `runtime`.

### Assigning Middleware to Routes

If you would like to assign middleware to specific route, you should first assign the middleware key in your
application's `app/config/middleware.php` file by default the array key `named`, you may add your own middleware.

```php
/**
* Register middleware named can be used using route or middleware class
* route : $route->get('uri', [controller:class, 'method'])->middleware('namedMiddleware');
* Middleware::Run('namedMiddleware');
*/
'named' => [
    'auth' => App\Http\Middleware\Auth::class,
]
```

Once the middleware has been defined in middleware config, you may use the middleware method to assign middleware to route.

```php
Route::get('uri', [controller::class, 'method'])->middleware('namedMiddleware');
```

You may assign multiple middleware to the route by passing an array of middleware names to middleware method.

```php
Route::get('uri', [controller:class, 'method'])->middleware(['firstmiddleware', 'secondmiddleware']);
```

## CSRF Protection

### Introduction

Cross-site request forgery are a type of malicious exploit whereby unauthorized commands are performed on behalf of an authenticated user.

### Preventing CSRF Requests

UnknownRori-PHP automatically generates a CSRF token for each active user session managed by the application, this token is used to verify that authenticated user is the person actually making requests to application.

The current session's CSRF token can be accessed via `csrf_token` helper function

```php
$token = csrf_token();
```

Anytime you define a `POST`, `PATCH`, `DELETE` in your html form in your application you should include a hidden CSRF `_csrf_token` field in the form so that CSRF protection middleware can validate requests. For convenience, you may use `csrf` helper function to generate hidden token input field.

```php
<form method="POST" action="/profile">
    {!! csrf() !!}
 
    <!-- Equivalent to... -->
    <input type="hidden" name="_csrf_token" value="{{ csrf_token() }}" />
</form>
```

The `App\Http\Middleware\VerifyCSRF::class` middleware, which is included in the `web` middleware group by default will automatically verify the token in the requests input.

## Controller

### Introduction

Controller can group related request handling logic into single class. For example, a UserController class might handle all incoming requests related to users, including showing, creating, updating, deleting users. By default, controller are stored in the `app/http/controller`

### Writing Controller

Let's take a look basic example. Note that the controller extends the base controller class included in this framework (But does not have any functionality yet).

```php
// web.php in route directory
<?php

Route::get("/", [Welcome::class, "index"]);


// Welcome.php in controller directory
<?php

namespace App\Http\Controller;

use App\Model\Users;
use Core\Controller;

class Welcome extends Controller
{
    function index()
    {
        return view('welcome', [
            'users' => Users::find(1)
        ]);
    }
}
```

When incoming request matches the specified uri, the `index` method on `App\Http\Controller\Welcome` class will be invoked.

### Route Resource

Sometime we want to make our life easier when writing a route definition, there are some method will come in handy if used properly, `resource` method will register typical `CRUD` like `index`, `show`, `create`, `store`, `edit`, `update`, `destroy`.

example:

```php
// web.php
Route::resource('user', [UserController::class]);
```

On current route system, it will generate these definition.

```
GET    : http://127.0.0.1:8000/user        | [UserController::class, index]

GET    : http://127.0.0.1:8000/user/show   | [UserController::class, show]

GET    : http://127.0.0.1:8000/user/create | [UserController::class, create]

POST   : http://127.0.0.1:8000/user/create | [UserController::class, store]

GET    : http://127.0.0.1:8000/user/edit   | [UserController::class, edit]

PATCH  : http://127.0.0.1:8000/user/edit   | [UserController::class, update]

DELETE : http://127.0.0.1:8000/user/delete | [UserController::class, destroy]
```

You can also filter some of the method that will registered by using `except` or `only` method.

```php
Route::resource('user', UserController::class)->except(['index', 'show']);
Route::resource('user2', UserController::class)->only(['create', 'store', 'edit', 'update', 'destroy']);
```

In the example above these will create typical `CRUD` but only `create`, `store`, `edit`, `update`, `destroy` method.

## Response

### Introduction

When we are working with frontend project using library like `vue` or `react` we may need rest api set up and `UnknownRori-PHP` has some convinient function and class to help making a api is easy.

### Creating Response

First of all we will take a look on helper function of `response` class, the function is `response` that return of instance of `response` class.

These function can send out header or response data.

```php
// stored in app/route/api.php

Route::get('/user', function () {
    return response()
                ->json([
                    'name' => 'John Doe',
                    'address' => 'Somewhere'
                ], 200)
                ->withHeaders([
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json'
                ]);
});
```

Normally we don't need to specify the content type because we already passing a data using `json` method.




## Validation

### Introduction

UnknownRori-PHP provide some approaches validation your application's incoming data. The most common way to use method `Validate` in `Validator` class.

If the validation fail it the `Validate` method will return `False` but if success it will return the data that passed the rules (you can pass data that does not defined in the rules but it wont be returned if the validation success).

### Validator

First let's assume we have following route

```php
// stored in app/route/web.php

Route::get('/user/show', [UserController::class, 'show']);
Route::post('/user', [UserController::class, 'show']);
```

and the controller with validation logic

```php
// stored in app/http/controller/UserController.php

<?php

namespace App\Http\Controller;

use App\Model\Users;
use Core\Http\Request;
use Core\Support\Validator\Validator;
use Core\Utils\Hash;

class UserController
{
    public function show()
    {
        $validate = Validator::validate(Request::get())->rules(['id' => ['numeric']]);
        dd(Users::find($validate['id']));
    }
    public function store()
    {
        $validate = Request::validate([
            'name' => ["string", "min:2"],
            "email" => ["string", "email"],
            "password" => ["string"],
        ]);
        Users::create($validate);
    }
}
```

### Request Validate

Because using `Validator` class need to pass the data you might want to use `Validate` method that ship in the `Request` class.

```php
$validate = Request::validate(['id' => ["numeric"]]);
```

## Views

### Introduction

Of course it's not pratical to return entire HTML documents directly from your routes and controllers. Thankfully, views provide a convinient way to place all of our HTML in seperate files. Views seperate your controller / application logic from your presentation logic and are stored in `app/views` directory. a simple view might look like this.

```html
    <!-- View stored in app/views/welcome.php -->

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Hello World</title>
    </head>

    <body>
        Hello <?= $users->get('name') ?>
    </body>

</html>
```

Since this view is stored in `app/views`, we may return it using global `view` helper inside our controller

```php
<?php

namespace App\Http\Controller;

use App\Model\Users;
use Core\Controller;

class Welcome extends Controller
{
    function index()
    {
        return view('welcome', [
            'users' => Users::find(1)
        ]);
    }
}
```

### Passing Data to Views

As you saw in the previous example, you may pass an array of data to views to make that data available to the view:

```php
return view('greetings', [
    'name' => 'Jane'
]);
```

When passing information in this manner, the data should be an array with key / value pairs. After providing data to a view, you can then access each value within your view using the data's keys, such as `<?php echo $name; ?>`.

### Blade One

`Blade One` is standalone blade package created by EFTEC to learn more about this click [this](https://github.com/EFTEC/BladeOne), but the package basicaly do this, first you create .blade.php file and the BladeOne will compile it to make it work as php file.

Example :

```php
{{ $foo }}
```

it will compiled as

```php
<?php echo \htmlentities($foo, ENT_QUOTES, 'UTF-8', false); ?>
```

## Session

### Retrieve Data

In this framework you can call `Session` Class helper which can be typed on Controller or on the view.

```php
<?php

namespace App\Http\Controller;

use Core\Controller;
use Core\Support\Session;

class Welcome extends Controller
{
    function index()
    {
        return view('welcome', [
            'users' => Session::get('key')
        ]);
    }
}
```

Or you can use the `session` helper function to make life much more easier.

```php
session()->get('key');
```

#### Retrieve All Session Data

If you would like to retrieve all the data in the session, you may just not passing any parameter.

```php
$session = Session::get();
```

### Storing Data

To store data in the session, you will typically use `Session` helper class method called `set`

```php
Session::set('name', 'John');
```

### Deleting Data

To delete data in the session you can use the Session helper class method called `unset`

```php
Session::unset('name');
```

### Destroying Current Session

To destroy the current session you can use these method.

```php
Session::destroy();
```

# Digging Deeper

## CLI

CLI is Command Line Interface included in this framework, CLI exists at the root of your application and provide you helpful command that can assist you while building application, you may use `help` command to list all available command.

    php cli help

## Collection

The `Core\Support\Collection` class provide simple and yet convinient wrapper with array of data, to make even more convinient is using the `collect` helper function but the effect is exactly the same, for example:

```php
$article = collect([
    'title' => 'Lorem',
    'content' => 'Lorem ipsum',
    'author' => 'John',
]);

$article->map(function ($name) {
    return strtoupper($name);
});

$modifiedArticle = $article->get();
```

### Creating Collection

As mentioned above the `Collection` class helper return collection instance for the given array.

```php
$collection = collect([1, 2, 3])
```

### Available Method

- first
- last
- find
- get
- key
- map
- filter
- split
- removeKeyInt
- push
- pop
- merge
- remove
- save
- update
- rollback
- revert

## Str

`\Core\Support\Str` provide simple and yet convinient String function wrapper, it also come with Str helper function to make life even easier.

### Creating Str

To create the `Str` Object we can call `\Core\Support\Str` or use `Str` function

```php
// Using helper hunction

$str = str('Foo');

// Using the class itself
use Core\Support\Str\Str;

$str = new Str('Foo');
```

Example usage

```php
// Using helper function

$str = str('foo')->upper(); // it will return FOO instead of Foo
```

### Available Method

- upper
- split
- explode
- ltrim
- upperFirst
- upperFirstWord
- count
- length
- lower
- get
- substr

## File Storage

### File

In this framework provide basic and yet very elegants, thanks to the `Core\Support\Filesystem\Storage` class, all the configuration on the filesystem can be located in `app/config/filesystem.php`.

There also some `Core\Support\Filesystem\File` class that help manage basic operation on file, for example write, read, modified time, deletion, copy.

```php
use Core\Support\Filesystem\File

$file = new File("app/storage/tests.json");
echo $file->get();
echo $file->modified();
```

#### Available Method

- copy
- write
- destroy
- type
- get
- path
- modified
- createTimestamp
- lastAccess

### File Uploads

In web application, one of the most common use cases for storing files is storing user uploaded files such as photos or documents, in this framework makes relative easy to store uploaded file using `upload` method

```php
use Core\Support\Filesystem\Storage;
use Core\Support\Http\Request;

Storage::upload(Request::file('image'));
```

## Cache

### Introduction

Some data retrival or proccessing data task performed by your application could be CPU intensive task or take several minute to complete. When this is the case, it is common to cache the retrieved data for a time so it can be retrieved more quickly on subsequent requests of the same data.

### Configuration

Your application's cache configuration is stored in `app/config/cache.php`. In this file you may specify which cache method to use, by default it will use filesystem json to cache data.

### Cache Usage

To use cache you can call `remember` method in `Cache` class.

```php
use App\Model\Users;
use Core\Support\Cache\Cache;

$data = Cache::remember('key', 3600, function () {
    return Users::all();
})
```

# Security

## Authentication

Many web application provide a way for users to authenticate with the application and login. Implementing these feature in the web application can be complex and risky, but in this framework also include buit in very basic authentication system.

### Authenticating Users

We will access authentication in this framework via `Core\Auth` class, now let's check out the `attempt` method, the attempt method is normaly used to handle authentication attempt from your application login form, if the authentication successfully, it will use `session` to keep the user logged in.

```php
use Core\Auth;

Auth::attempt([
    'username' => 'John',
    'password' => 'John_Password'
]);
```

You can customize `Auth` class behavior inside the `app/config/auth.php`

```php
return [
    'table' => 'users',
    'session_name' => 'USER',
    'primary_key' => 'id',
    'unique_key' => 'name',
    'verify_key' => 'password',
    'guarded' => ['password', 'email'],
];
```

`table` key is used for target verification table.

`session_name` key  is used for session name that will be registered inside the server.

`primary_key` key is primary key inside target table.

`unique_key` key is unique key column inside target table, this will be used for verification.

`verify_key` key is password column that will be used for verificate the unique_key (`username` for example).

`guarded` key is used for filtering data that will be retrived when the verification success.

### Protecting Route

Theres are time that the route needed to be protected for example the `/dasbhoard` should be accessible on logged in users, these route protection use middleware that can be define in route

```php
Route::get('/dashboard', [Dashboard::class, 'index'])->middleware('auth');
```

You can create your own middleware for security purposes and added in the `app/config/middleware.php` to register middleware for route.

### Logging out the users

Logging out the users using the built in authentication is very easy we can use `logout` method to log the users out.

```php
use Core\Auth;

Auth::logout();
```

## Hashing

In this framework `Core\Utils\Hash` class can provide secure Bcrpyt and Argon hashing for storing user password, by default the hashing algorithm used is `PASSWORD_DEFAULT`.

Bcrypt is a great choice for hashing passwords because its "work factor" is adjustable, which means that the time it takes to generate a hash can be increased as hardware power increases. When hashing passwords, slow is good. The longer an algorithm takes to hash a password, the longer it takes malicious users to generate "rainbow tables" of all possible string hash values that may be used in brute force attacks against applications.

### Configuration

The default hashing driver for your application can be configured in `.env` file while the hashing option can be found in `app/config/hash.php`

### Basic Usage

To hash a password you can call `make` method on `Core\Utils\Hash`:

```php
use Core\Utils\Hash;

Hash::make("Something");
```

### Verify

The `check` method provided by `Hash` helper class allows you to verify that given plain-text string corresponds to given hash.

```php
if(Hash::check($plaintext, $hash))
{
    // Do something.
}
```

# Database

## Overview

Almost every modern web application interact with a database, in this framework interacting with database relative simple across a variety of supported databases using raw sql because it use `PDO`, while the predefined database function and Database Model currently supported in `Mysql`.

## Configuration

In this framework database configuration can be found inside `app/config/db.php` while the driver you wanted to use can be modified inside `.env`

## Query

### Raw Query

Once you have configured your database connection,  you may run query using `Core\Database\DB` class, in this class it provide wide variety method to do, example doing raw query or prepared statement query and more!

Important Note : All the returning value from all these query is a `Core\Support\Collection`

In this example we are doing raw query:

Note : Since we running a raw query there is possibilty that we might run into sql injection attack.

```php
// Selecting all data inside a table using raw sql
use Core\Database\DB;

$users = DB::query("SELECT * FROM users")->fetchAll();
```

---

```php
// Selecting specific data inside a table using raw sql
use Core\Database\DB;

$id = 1;

$users = DB::query("SELECT * FROM users WHERE id={$id}")->fetch();
```

In the example above, `query` method is used to put all our sql query while the `fetchAll` method is used to fetch all the selected data, while fetch will only return one data, after that it will store inside users variable.

```php
// Inserting data inside a table using raw sql
use Core\Database\DB;
$boolean  = DB::query("INSERT INTO users (username, email, password) VALUES('John', 'John@mail.com', 'Hashed Password')")->executeClose();
```

So in the example above is an simple example how to put a thing inside database's table, and there are 2 method for executing query `execute` method and `executeclose` method, these two method are slightly bit different, the diffrence is `executeclose` is executing the sql query and then close the connection, same as `fetch` and `fetchAll` method these will always close the connection.

### Prepared Statement

Since doing raw query is vulnerable with sql injection attack, there are available method that use prepared statement, let's do same example but using prepared statement

```php
// Selecting all data inside a table using prepared statement
use Core\Database\DB;

$users_collection = DB::prepare("SELECT * FROM users")->fetchAll();
```

---

```php
// Selecting specific data inside a table using prepared statement
use Core\Database\DB;

$id = 1;

$user_collection = DB::prepare("SELECT * FROM users WHERE id=?")->fetch([$id]);
```

---

```php
// Inserting data inside a table using prepared statement
use Core\Database\DB;

$data = ["John", "John@mail.com", "HashedPassword"];
$boolean  = DB::prepare("INSERT INTO users (name, email, password) VALUES(?, ?, ?)")->executeclose($data);
```

### List Method

- query
- prepare
- execute
- executeclose
- fetchAll
- fetch
- close

## Built in Database Method

### Overview

Built in database method is available in `Core\Database\DB` classes, these method will help speed up development since these method just extended version of basic `DB` method.

Theres are few built in database method, for example we will use the example above for demonstration:

```php
// Selecting all data inside a table using Built in
use Core\Database\DB;

$users_collection = DB::table('users')->all();
```

---

```php
// Selecting specific data inside a table using prepared statement
use Core\Database\DB;

$user_collection = DB::table('users')->find(1);
```

---

```php
// Inserting data inside a table using prepared statement
use Core\Database\DB;

$data = [
    'name' => "John",
    'email' => "John@mail.com",
    'password' => "hashed password"
];

$boolean = DB::table('users')->create($data);
```

Note : to use `create` method you should passed associative array instead of normal array

---

```php
// Updating data in database
use Core\Database\DB;

$data = [
    'id' => 1,
    'name' => "John Smith",
    'email' => "John@mail.com",
    'password' => "hashed password"
];

$boolean = DB::table('users')->update($data);
```

---

```php
    // Deleting data in database
    use Core\Database\DB;

    $id = 1;

    $boolean = DB::table('users')->destroy($id);
```

### List Method

- table
- find
- create
- destroy
- update

## Database Collection

Since all the database returning value is in `Core\Support\Collection`, you can edit the value and save it to persist in database, for example:

Note : This feature only work using `find` method

```php
use Core\Database\DB;

$user = DB::table('users')->find(2);

$user->fill([
    "name" => "John Smith",
    "email" => "John@mail.com",
    "password" => "hashedpassword"
]);

$boolean = $user->save();
```

Or maybe you `fill` half of the data it will work regardless as long you use `fill` method.

```php
use Core\Database\DB;

$user = DB::table('users')->find(2);

$user->fill([
    "email" => "JohnSmith@mail.com",
]);

$boolean = $user->save();
```

## Database Model

In this framework included very basic database model, this makes little bit easier when interacting with database, when using this feature each database table corresponding with `Model` that used to interact with that table, in this feature allows you to insert, update, delete record from the table.

### Generating Model Class

To get started, let's create model. Model typically live in the `app/model` and extends `Core\Model` class. You may use the `make:model` in CLI to generate a new model.

    php cli make:model Posts

After generating the class the file will looks like this

```php
<?php

namespace App\Models;
use Core\Model;

class Posts extends Model
{
    // Code Here
}
```

### Table Name

After glancing on the file above, you may noticed that we did not tell the model which database table correspond to this Posts Model, so let's add this object property inside `Posts` class

```php
protected $table = 'post';
```

After we add this we now have the basic CRUD using model, we can use the same name convention method in `Core\Database\DB`, like find, where, insert, delete, all.

```php
// Selecting all data using database model
use App\Models\Posts;

$posts = Posts::all();
```

Database model will always assume that database table has primary key `id`. If necessarry, you may define `protected $primary_key` property on your model to specify a different column that serves as your model's primary key.

```php
protected $primary_key = 'posts_id';
```

### Model Relationship

Database table are often related to one another, for example blog post may have many comments or and order could be related to to the user who place it

#### Defining Relationship

Defining the relationship inside your model is very simple, by using protected object called hasMany or belongsTo

##### Has Many

A one-to-many relationship is used to define relationships where a single model is the parent to one or more child models. For example, a user may have an infinite number of posts.

```php
<?php

namespace App\Model;

use App\Models\Posts;
use Core\Model;


class Users extends Model
{
    protected $table = "users";
    protected $hasMany = [Posts::class, 'users_id'];
}
```

To use the relationship that we already define:

```php
Users::find(1, 'hasMany');
```

##### Belongs To

Now that we can access all of a user's posts, let's define a relationship to allow a posts to access its parent user. To define the inverse of a hasMany relationship, define a relationship method on the child model which calls the belongsTo method:

```php
<?php

namespace App\Models;

use App\Model\Users;
use Core\Model;

class Posts extends Model
{
    protected $table = 'post';
    protected $belongsTo = [Users::class, 'users_id'];
}
```

To use the relationship that we already define:

```php
Posts::find(1, 'belongsTo');
```

### List Method

- all
- find
- create
- destroy
- paginate
