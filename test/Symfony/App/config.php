<?php

$container->loadFromExtension('framework', [
    'router' => [
        'resource' => __DIR__.'/routing.php',
    ],
    'secret' => 'secret',
    'test' => true,
]);
