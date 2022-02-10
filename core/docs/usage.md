# Usage Documentation

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

    - Creating Collection

    - Available Method

  - File Storage

    - File Upload

- Security

  - Authentication

    - Authenticating Users

    - Protecting Route

    - Logging out the users

  - Hashing

    - Configuration

    - Basic Usage

    - Verify

- Database

  - Overview

  - Configuration

  - Query

    - Raw Query

    - Prepared Statement

    - List Method

  - Built in Database Method

    - Overview

    - List Method

  - Database Collection

  - Database Model

    - Generating Model Class

    - Table Name

    - Model Relationship

      - Defining Relationship

        - Has Many

        - Belongs To

    - List Method

# The Basic

## Routing

The most basic Rori-PHP routes accept a URI and a closure, provide a simple and expressive method of defining routes and behavior without complicated routing configuration files:

    Route::get('/', function () {
        return view("welcome");
    });

Instead of defining all of your request handling logic as closures in your route files, you may wish to organize this behavior using `controller` classes. Controllers can group related request handling logic into a single class. For example, a UserController class might handle all incoming requests related to users, including showing, creating, updating, and deleting users. By default, controllers are stored in the `app/http/controller` directory.

You can define a route to this controller method like so:

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

    // Redirect
    Route::Redirect('user');

If the named route defines parameters, you may pass the parameters as the second argument to the route function. The given parameters will automatically be inserted into the generated URL in their correct positions:

    $url = route('profile', ['id' => 1]);

### Route Group

Route groups allow you to share route attributes, such as middleware across a large number of route without define those attributes on each individual route, Nested group will attempt to merge, middleware and name are appended.

#### Middleware

To assign middleware to all route inside the group, you may used group method to define middleware and the route of the group

    Route::group('test')->by(function () {
        Route::get('/group/1', [Group::class, 'index']);
        Route::get('/group/2', [Group::class, 'index']);
    });

## Middleware

Middleware provide a convenient mechanism for inspecting and filtering HTTP requests entering your application, Additional middleware can be written to perform a variety of tasks besides authentication, All of these middleware are located in the `app/config/middleware.php`.

### Defining Middleware

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

# Digging Deeper

## CLI

CLI is Command Line Interface included in this framework, CLI exists at the root of your application and provide you helpful command that can assist you while building application, you may use `help` command to list all available command.

    php cli help

## Collection

The `Core\Support\Collection` class provide simple and yet convinient wrapper with array of data, for example

    $article = new Collection([
        'title' => 'Lorem',
        'content' => 'Lorem ipsum',
        'author' => 'John',
    ]);

    $article->map(function ($name) {
        return strtoupper($name);
    });

    $modifiedArticle = $article->getData();

### Creating Collection

As mentioned above the `Collection` class helper return collection instance for the given array.

    $collection = new Collection([1, 2, 3])

### Available Method

- first
- last
- find
- get
- key
- map
- filter
- split
- getData
- push
- merge
- remove
- save

## File Storage

In this framework provide basic and yet very elegants, thanks to the `Core\Support\Filesystem\Storage` class, all the configuration on the filesystem can be located in `app/config/filesystem.php`.

## Storing Files

### File Uploads

In web application, one of the most common use cases for storing files is storing user uploaded files such as photos or documents, in this framework makes relative easy to store uploaded file using `upload` method

    use Core\Support\Filesystem\Storage;
    use Core\Support\Http\Request;

    Storage::upload(Request::File('image'));

# Security

## Authentication

Many web application provide a way for users to authenticate with the application and login. Implementing these feature in the web application can be complex and risky, but in this framework also include buit in very basic authentication system.

### Authenticating Users

We will access authentication in this framework via `Core\Auth` class, now let's check out the `attempt` method, the attempt method is normaly used to handle authentication attempt from your application login form, if the authentication successfully, it will use `session` to keep the user logged in.

    use Core\Auth;

    Auth::attempt([
        'username' => 'John',
        'password' => 'John_Password'
    ]);

### Protecting Route

Theres are time that the route needed to be protected for example the `/dasbhoard` should be accessible on logged in users, these route protection use middleware that can be define in route

    Route::get('/dashboard', [Dashboard::class, 'index'])->middleware('auth');

You can create your own middleware for security purposes and added in the `app/config/middleware.php` to register middleware for route.

### Logging out the users

Logging out the users using the built in authentication is very easy we can use `logout` method to log the users out.

    Auth::logout();

## Hashing

In this framework `Core\Utils\Hash` class can provide secure Bcrpyt and Argon hashing for storing user password, by default the hashing algorithm used is `PASSWORD_DEFAULT`.

Bcrypt is a great choice for hashing passwords because its "work factor" is adjustable, which means that the time it takes to generate a hash can be increased as hardware power increases. When hashing passwords, slow is good. The longer an algorithm takes to hash a password, the longer it takes malicious users to generate "rainbow tables" of all possible string hash values that may be used in brute force attacks against applications.

### Configuration

The default hashing driver for your application can be configured in `.env` file while the hashing option can be found in `app/config/hash.php`

### Basic Usage

To hash a password you can call `make` method on `Core\Utils\Hash`:

    use Core\Utils\Hash;

    Hash::make("Something");

### Verify

The `check` method provided by `Hash` helper class allows you to verify that given plain-text string corresponds to given hash.

    if(Hash::verify($plaintext, $hash))
    {
        // Do something.
    }

# Database

## Overview

Almost every modern web application interact with a database, in this framework interacting with database relative simple across a variety of supported databases using raw sql because it use `PDO`, while the predefined database function and Database Model currently supported in `Mysql`.

## Configuration

In this framework database configuration can be found inside `app/config/db.php` while the driver you wanted to use can be modified inside `.env`

## Query

### Raw Query

Once you have configured your database connection,  you may run query using `Core\Database\DB` class, in this class it provide wide variety method to do, example doing raw query or prepared statement query and more!

### `Important Note` : All the returning value from all these query is a `Core\Support\Collection`

In this example we are doing raw query:

Note : Since we running a raw query there is possibilty that we might run into sql injection attack.

    // Selecting all data inside a table using raw sql
    use Core\Database\DB;

    $users = DB::query("SELECT * FROM users")->fetchAll();

---

    // Selecting specific data inside a table using raw sql
    use Core\Database\DB;

    $id = 1;

    $users = DB::query("SELECT * FROM users WHERE id={$id}")->fetch();

In the example above, `query` method is used to put all our sql query while the `fetchAll` method is used to fetch all the selected data, while fetch will only return one data, after that it will store inside users variable.

    // Inserting data inside a table using raw sql
    use Core\Database\DB;
    $boolean  = DB::query("INSERT INTO users (username, email, password) VALUES('John', 'John@mail.com', 'Hashed Password')")->executeclose();

So in the example above is an simple example how to put a thing inside database's table, and there are 2 method for executing query `execute` method and `executeclose` method, these two method are slightly bit different, the diffrence is `executeclose` is executing the sql query and then close the connection, same as `fetch` and `fetchAll` method these will always close the connection.

### Prepared Statement

Since doing raw query is vulnerable with sql injection attack, there are available method that use prepared statement, let's do same example but using prepared statement

    // Selecting all data inside a table using prepared statement
    use Core\Database\DB;

    $users_collection = DB::prepare("SELECT * FROM users")->fetchAll();

---

    // Selecting specific data inside a table using prepared statement
    use Core\Database\DB;

    $id = 1;

    $user_collection = DB::prepare("SELECT * FROM users WHERE id=?")->fetch([$id]);

---

    // Inserting data inside a table using prepared statement
    use Core\Database\DB;
    
    $data = ["John", "John@mail.com", "HashedPassword"];
    $boolean  = DB::prepare("INSERT INTO users (name, email, password) VALUES(?, ?, ?)")->executeclose($data);

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

    // Selecting all data inside a table using Built in
    use Core\Database\DB;

    $users_collection = DB::table('users')->all();

---

    // Selecting specific data inside a table using prepared statement
    use Core\Database\DB;

    $user_collection = DB::table('users')->find(1);

---

    // Inserting data inside a table using prepared statement
    use Core\Database\DB;

    $data = [
        'name' => "John",
        'email' => "John@mail.com",
        'password' => "hashed password"
    ];

    $boolean = DB::table('users')->insert($data);

Note : to use insert method you should passed associative array instead of normal array

---

    // Updating data in database
    use Core\Database\DB;

    $data = [
        'id' => 1,
        'name' => "John Smith",
        'email' => "John@mail.com",
        'password' => "hashed password"
    ];
    
    $boolean = DB::table('users')->update($data);

---

    // Deleting data in database
    use Core\Database\DB;

    $id = 1;

    $boolean = DB::table('users')->delete($id);

### List Method

- table
- find
- insert
- delete
- update

## Database Collection

Since all the database returning value is in `Core\Support\Collection`, you can edit the value and save it to persist in database, for example:

Note : This feature only work using `find` method

        use Core\Database\DB;

        $user = DB::table('users')->find(2);
        
        $user->fill([
            "name" => "John Smith",
            "email" => "John@mail.com",
            "password" => "hashedpassword"
        ]);

        $boolean = $user->save();

Or maybe you `fill` half of the data it will work regardless as long you use `fill` method.

        use Core\Database\DB;

        $user = DB::table('users')->find(2);

        $user->fill([
            "email" => "JohnSmith@mail.com",
        ]);

        $boolean = $user->save();

## Database Model

In this framework included very basic database model, this makes little bit easier when interacting with database, when using this feature each database table corresponding with `Model` that used to interact with that table, in this feature allows you to insert, update, delete record from the table.

### Generating Model Class

To get started, let's create model. Model typically live in the `app/model` and extends `Core\Model` class. You may use the `make:model` in CLI to generate a new model.

    php cli make:model Posts

After generating the class the file will looks like this

    <?php

    namespace App\Models;
    use Core\Model;

    class Posts extends Model
    {
        // Code Here
    }

### Table Name

After glancing on the file above, you may noticed that we did not tell the model which database table correspond to this Posts Model, so let's add this object property inside `Posts` class

    protected $table = 'post';

After we add this we now have the basic CRUD using model, we can use the same name convention method in `Core\Database\DB`, like find, where, insert, delete, all.

    // Selecting all data using database model
    use App\Models\Posts;
    
    $posts = Posts::all();

Database model will always assume that database table has primary key `id`. If necessarry, you may define `protected $primary_key` property on your model to specify a different column that serves as your model's primary key.

    protected $primary_key = 'posts_id';

### Model Relationship

Database table are often related to one another, for example blog post may have many comments or and order could be related to to the user who place it

#### Defining Relationship

Defining the relationship inside your model is very simple, by using protected object called hasMany or belongsTo

##### Has Many

A one-to-many relationship is used to define relationships where a single model is the parent to one or more child models. For example, a user may have an infinite number of posts.

    <?php

    namespace App\Model;

    use App\Models\Posts;
    use Core\Model;


    class Users extends Model
    {
        protected $table = "users";
        protected $hasMany = [Posts::class, 'users_id'];
    }

To use the relationship that we already define:

    Users::find(1, 'hasMany');

##### Belongs To

Now that we can access all of a user's posts, let's define a relationship to allow a posts to access its parent user. To define the inverse of a hasMany relationship, define a relationship method on the child model which calls the belongsTo method:

    <?php

    namespace App\Models;

    use App\Model\Users;
    use Core\Model;

    class Posts extends Model
    {
        protected $table = 'post';
        protected $belongsTo = [Users::class, 'users_id'];
    }

To use the relationship that we already define:

    Posts::find(1, 'belongsTo');

### List Method

- all
- find
- insert
- delete
- paginate
