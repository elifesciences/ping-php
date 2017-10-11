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
