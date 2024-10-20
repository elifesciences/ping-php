<?php

use eLife\Ping\PingController;

$container->register('ping.controller', PingController::class)
    ->setTags(['controller.service_arguments' => []]);
