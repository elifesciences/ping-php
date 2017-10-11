<?php

namespace eLife\Ping\Silex;

use eLife\Ping\PingController;
use Pimple\Container;
use Pimple\ServiceProviderInterface;
use Silex\Api\BootableProviderInterface;
use Silex\Api\ControllerProviderInterface;
use Silex\Application;
use Silex\ControllerCollection;

final class PingControllerProvider implements BootableProviderInterface, ControllerProviderInterface, ServiceProviderInterface
{
    public function boot(Application $app)
    {
        $app->mount('/', $this->connect($app));
    }

    public function connect(Application $app) : ControllerCollection
    {
        $controllers = $app['controllers_factory'];

        $controllers->get('/ping', function () use ($app) {
            return $app['ping.controller']->pingAction();
        })->bind('ping');

        return $controllers;
    }

    public function register(Container $app)
    {
        $app['ping.controller'] = function () {
            return new PingController();
        };
    }
}
