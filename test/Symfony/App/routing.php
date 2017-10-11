<?php

use Symfony\Component\Routing\RouteCollection;

$collection = new RouteCollection();

$collection->addCollection(
    $loader->import('@PingBundle/Resources/config/routing.php')
);

return $collection;
