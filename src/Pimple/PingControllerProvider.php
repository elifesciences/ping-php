<?php

namespace eLife\Ping\Pimple;

use eLife\Ping\PingController;
use eLife\Ping\Psr\PingController as PsrPingController;
use Pimple\Container;
use Pimple\ServiceProviderInterface;
use RuntimeException;

final class PingControllerProvider implements ServiceProviderInterface
{
    public function register(Container $app)
    {
        $app['ping.controller'] = function () {
            return new PingController();
        };

        $app['ping.psrcontroller'] = function () use ($app) {
            if (!isset($app['psr17factory'])) {
                throw new RuntimeException('You must register a PSR-17 factory at `psr17factory` before using this service provider.');
            }
            return new PsrPingController($app['psr17factory'], $app['psr17factory']);
        };
    }
}
