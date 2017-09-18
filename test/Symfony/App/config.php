<?php

$container->loadFromExtension('framework', [
    'router' => [
        'resource' => '%kernel.project_dir%/routing.php',
    ],
    'secret' => 'secret',
    'test' => true,
]);
