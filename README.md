eLife Ping PHP
==============

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

Running the tests
-----------------

`vendor/bin/phpunit`
