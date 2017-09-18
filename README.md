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
