eLife Ping PHP
==============

[![Build Status](https://ci--alfred.elifesciences.org/buildStatus/icon?job=library-ping-php)](https://ci--alfred.elifesciences.org/job/library-ping-php/)

This library provides a ping controller for the eLife Sciences applications.

Dependencies
------------

* [Composer](https://getcomposer.org/)
* PHP 7

Installation
-------------

`composer require elife/ping`

Set up
------

### Silex

```php
use eLife\Ping\Silex\PingControllerProvider;

$app->register(new PingControllerProvider());
```

You can set the `ping.check` service to a callable, if an exception is thrown the ping controller will return a `500 Internal Server Error` response.

```php
$app['ping.check'] = function () use ($app) {
    // Check that the database is available
    $app['db']->query('SELECT 1');
};
```

You can set the `ping.logger` service to log failures. By default it will use `$app['logger']`.

```
$app['ping.logger'] = function () {
    return new MyLogger();
};
```

### Symfony

Add `eLife\Ping\Symfony\PingBundle` to your application's kernel.

Add to your routing file:

```yaml
ping:
  resource: '@PingBundle/Resources/config/routing.php'
```

Running the tests
-----------------

`vendor/bin/phpunit`
