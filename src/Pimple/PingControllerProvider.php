<?php

namespace eLife\Ping\Pimple;

use eLife\Ping\PingController;
use Pimple\Container;
use Pimple\ServiceProviderInterface;

final class PingControllerProvider implements ServiceProviderInterface
{
    public function register(Container $app)
    {
        $app['ping.controller'] = function () {
            return new PingController();
        };
    }
}
