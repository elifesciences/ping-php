<?php

use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;

$collection = new RouteCollection();

$collection->add('ping', new Route('/ping', ['_controller' => 'ping.controller:pingAction']));

return $collection;
