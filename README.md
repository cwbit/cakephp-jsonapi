# cakephp-jsonapi
Set of libraries for building standardized JSON responses in CakePHP 3.x REST APIs

***WHY?***
I needed a consistent way to get REST reponses back from my API controllers. Additionally, there's a few basic setup steps that a Controller needs in order to properly handle JSON request/responses.

***HOW?***
Just add the `JsonControllerTrait` to turn any Controller into a JSON-friendly controller.
Add the `JsonResponseTrait` to expose a number of response functions (detailed below).

## Requirements

* PHP 5.4+
* [CakePHP 3.x](http://cakephp.org)

## TOC
1. [Plugin Installation]()
2. [Usage]()
3. [Response Methods]()
4. [Contributing]()

### Plugin Installation

1. [Composer Install]()
2. [Manual Install]()
  3. [Loading the plugin in your app]()
  4. [Setting up the namespace / autoloader]()
  
#### Composer Install

This plugin is on Packagist which means it can be easily installed with Composer.

```
composer require cwbit/cakephp-jsonapi:dev-master
```
Then simply load the plugin normally in your `config/bootstrap.php` file

```php
# in ../config/bootstrap.php - right after Plugin::load('Migrations') is fine!
Plugin::load('JsonApi');
```

#### Manual Install

You can also manually load this plugin in your App.

:warning: Installing the plugin without the use of Composer is not officially supported. You do so at your own risk.

##### loading the plugin in your app
Add the source code in this project into `plugins/JsonApi`

Then configure your App to actually load this plugin

```php
# in ../config/bootstrap.php
Plugin::load('JsonApi');
```

##### setting up the namespace / autoloader
Tell the autoloader where to find your namespace in your `composer.json` file

```json
	(..)
    "autoload": {
        "psr-4": {
           (..)
            "JsonApi\\": "./plugins/JsonApi/src"
        }
    },
    (..)
```
Then you need to issue the following command on the commandline
```
	php composer.phar dumpautoload
```
If you are unable to get composer autoloading to work, add `'autoload' => true` line in your `bootstrap.php` `Plugin::load(..)` command (see loading section)

## Usage

The easiest way to get this set up is to simply add an Api namespace to your App. This way you can control exactly what your API does.

To set up an Api namespace, add the following to your `routes.php`

```php
# in routes.php
Router::prefix('api', function ($routes) {
    $routes->fallbacks('InflectedRoute');
});
```
Then, create an Api controller inside `src/Controller/Api`

```php
<?php

namespace App\Controller\Api;

use App\Controller\AppController as Controller;
use App\Controller\Api\JsonControllerTrait;
use App\Controller\Api\JsonResponseTrait;

class AppController extends Controller
{
	
	use JsonControllerTrait;
	use JsonResponseTrait;

}
```
That's it! Now any of your controllers inside the Api namespace can automatically accept and respond to JSON calls

```php
<?php
namespace App\Controller\Api;

use App\Controller\Api\AppController;

class FoosController extends AppController
{
	public function view()
	{
		# if no ID passed, respond with error 400
		if (!$this->request->data('id')) :
			return $this->respondWithBadRequest('Foo id is required');
		endif;
		
		# .. etc
	}
}
```

## Response Methods
The `JsonResponseTrait` exposes the following response functions

* `respondWith($statusCode, $message, $data)`
* **SUCCESS**
* `respondWithOK($message, $data)` - Status **200** - OK
* `respondWithCreated($message, $data)` - Status **201** - CREATED
* `respondWithNoContent($message, $data)` - Status **204** - NO CONTENT
* **REDIRECTION**
* `respondWithMovedPermanently($message, $data)` - Status **301** - MOVED PERMANENTLY
* `respondWithMovedTemporarily($message, $data)` - Status **302** - MOVED TEMPORARILY
* `respondWithSeeOther($message, $data)` - Status **303** - SEE OTHER
* **CLIENT ERROR**
* `respondWithBadRequest($message, $data)` - Status **400** - BAD REQUEST
* `respondWithUnauthorized($message, $data)` - Status **401** - UNAUTHORIZED
* `respondWithForbidden($message, $data)` - Status **403** - FORBIDDEN
* `respondWithNotFound($message, $data)` - Status **404** - NOT FOUND
* `respondWithMethodNotAllowed($message, $data)` - Status **405** - METHOD NOT ALLOWED
* `respondWithConflict($message, $data)` - Status **409** - CONFLICT
* **SERVER ERROR**
* `respondWithInternalServerError($message, $data)` - Status **500** - INTERNAL SERVER ERROR

## Contributing
If you'd like to contribute, please fork this repo, and make a PR of your changes!
Any PRs with accompanying tests are much more likely to be accepted.