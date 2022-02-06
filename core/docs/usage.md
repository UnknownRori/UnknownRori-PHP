# Usage Documentation(WIP)

## Table of Content

- The Basic

  - Routing

    - Default Route Files

    - Route Name prefix

      - Generating URI to Named Routes

    - Route Group

      - Middleware

  - Middleware

    - Introduction

    - Defining Middleware

    - Global Middleware

    - Assigning Middleware to Routes

  - Controller

    - Introduction

    - Writing Controller

  - Views

    - Introduction

    - Passing Data to Views

  - Session

    - Interacting with the Session

      - Retrieve Data

        - Retrieve All Session Data

      - Storing Data

      - Deleting Data

      - Destroying Current Session

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

    Route::get('/', [Home::class, 'index']);

### Default Route Files

All UnknownRori-PHP routes are defined in route file, which is located in `app/route` directory, these file automatically loaded by `Core\Kernel`, the `app/route/web.php` file defines routes that are for your web interface. These routes can be assigned to the middleware.

For most application, you will begin by defining routes inside `app/route/web.php` file, these defined route URL can be accessed using your browser, for example `localhost:8080/user` in your browser

    Route::get('/user', [User::class, 'index']);

The router allows you to register routes that respond to any HTTP verb

    Route::get('/', [Welcome::class, 'index']);
    Route::post('/', [Welcome::class, 'index']);
    Route::delete('/', [Welcome::class, 'index']);
    Route::patch('/', [Welcome::class, 'index']);

### Route Name prefix

Named routes allow the convenient generation of URI or redirect for specific routes. You may specify a name for route by chaining `name` method onto route definition

    Route::get('/user', [UserController::class, 'index'])->name('user');

#### Generating URI to Named Routes

Once you assigned a name on given route, you may use the route's name when generating URI or `redirect` helper method

    // Generating URI
    $uri = Route::GetRoute('user');

    // Generating Redirect
    Route::Redirect('user');

If the named route defines parameters, you may pass the parameters as the second argument to the route function. The given parameters will automatically be inserted into the generated URL in their correct positions:

    $url = route('profile', ['id' => 1]);

### Route Group

Route groups allow you to share route attributes, such as middleware across a large number of route without define those attributes on each individual route, Nested group will attempt to merge, middleware and name are appended.

#### Middleware

To assign middleware to all route inside the group, you may used group method to define middleware and the route of the group

    Route::middleware('test')->group(function () {
        Route::get('/group/1', [Group::class, 'index']);
        Route::get('/group/2', [Group::class, 'index']);
    });

## Middleware

Middleware provide a convenient mechanism for inspecting and filtering HTTP requests entering your application, Additional middleware can be written to perform a variety of tasks besides authentication, All of these middleware are located in the `app/config/middleware.php`.

### Defining Middleware

#### WIP

To create new middleware, use `make:middleware` cli command

    php cli make:middleware EnsureAdmin

This command will place new `EnsureAdmin` class inside your `app/http/middleware`. In this middleware, we will only allow access the route if the user is authenticate as admin, if the user haven't authenticate it will redirect back to login uri, if already authenticate it will redirect back to home.

    <?php

    namespace App\Http\Middleware;

    use Core\Auth;

    class EnsureAdmin
    {
        public function Run()
        {
            if (Auth::check()) {
                if (Auth::User()->get('admin')) {
                    return header("Location: /something");
                }
            }

            return header("Location: /login");
        }
    }

As you can see, if the user is not an admin or have not authenticate it will redirect to `/login` if the user is an admin it will redirect to `/something`.

### Global Middleware

If you want a middleware to run during every http request to your application, you can add it inside `app/config/middleware.php` in this file there are two array will be returned `runtime` and `named`. To add middleware to every http request, you can add it inside `runtime`.

### Assigning Middleware to Routes

If you would like to assign middleware to specific route, you should first assign the middleware key in your
application's `app/config/middleware.php` file by default the array key `named`, you may add your own middleware.

        /**
        * Register middleware named can be used using route or middleware class
        * route : $route->get('uri', [controller:class, 'method'])->middleware('namedMiddleware');
        * Middleware::Run('namedMiddleware');
        */
        'named' => [
            'test' => App\Http\Middleware\test::class, // This is still for testing purposes
        ]

Once the middleware has been defined in middleware config, you may use the middleware method to assign middleware to route.

    Route::get('uri', [controller::class, 'method'])->middleware('namedMiddleware);

You may assign multiple middleware to the route by passing an array of middleware names to middleware method.

    Route::get('uri', [controller:class, 'method'])->middleware(['firstmiddleware', 'secondmiddleware']);

## Controller

### Introduction

Controller can group related request handling logic into single class. For example, a UserController class might handle all incoming requests related to users, including showing, creating, updating, deleting users. By default, controller are stored in the `app/http/controller`

### Writing Controller

Let's take a look basic example. Note that the controller extends the base controller class included in this framework (But does not have any functionality yet).

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

When incoming request matches the specified uri, the `index` method on `App\Http\Controller\Welcome` class will be invoked.

## Views

### Introduction

Of course it's not pratical to return entire HTML documents directly from your routes and controllers. Thankfully, views provide a convinient way to place all of our HTML in seperate files. Views seperate your controller / application logic from your presentation logic and are stored in `app/views` directory. a simple view might look like this.

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

Since this view is stored in `app/views`, we may return it using global `view` helper inside our controller

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

### Passing Data to Views

As you saw in the previous example, you may pass an array of data to views to make that data available to the view:

    return view('greetings', [
        'name' => 'Jane'
    ]);

When passing information in this manner, the data should be an array with key / value pairs. After providing data to a view, you can then access each value within your view using the data's keys, such as `<?php echo $name; ?>`.

## Session

### Retrieve Data

In this framework you can call `Session` Class helper which can be typed on Controller or on the view.

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

#### Retrieve All Session Data

If you would like to retrieve all the data in the session, you may just not passing any parameter.

    Session::get();

### Storing Data

To store data in the session, you will typically use `Session` helper class method called `set`

    Session::unset('name', 'John');

### Deleting Data

To delete data in the session you can use the Session helper class method called `unset`

    Session::unset('name');

### Destroying Current Session

To destroy the current session you can use these method.

    Session::destroy();
