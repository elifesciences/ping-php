<?php

namespace test\eLife\Ping\Pimple;

use eLife\Ping\PingController;
use eLife\Ping\Psr\PingController as PsrPingController;
use eLife\Ping\Pimple\PingControllerProvider;
use Nyholm\Psr7\Factory\Psr17Factory;
use PHPUnit\Framework\TestCase;
use Pimple\Container;
use RuntimeException;

final class PingControllerProviderTest extends TestCase
{
    /** @var Container */
    protected $container;

    /**
     * @test
     */
    public function it_creates_services()
    {
        $this->assertArrayHasKey('ping.controller', $this->container);
        $this->assertArrayHasKey('ping.psrcontroller', $this->container);
        $this->assertInstanceOf(PingController::class, $this->container['ping.controller']);
        $this->assertInstanceOf(PsrPingController::class, $this->container['ping.psrcontroller']);
    }

    /**
     * @test
     */
    public function it_creates_a_service()
    {
        $this->assertArrayHasKey('ping.controller', $this->container);
        $this->assertInstanceOf(PingController::class, $this->container['ping.controller']);
    }

    /**
     * @test
     */
    public function it_throws_error_when_dependency_not_found()
    {
        $container = new Container();
        $container->register(new PingControllerProvider());

        $this->assertArrayHasKey('ping.psrcontroller', $container);

        $this->expectException(RuntimeException::class);
        $container['ping.psrcontroller']; // throws error
    }

    protected function setup(): void
    {
        $this->container = new Container();
        $this->container->register(new PingControllerProvider());
        $this->container['psr17factory'] = function () {
            return new Psr17Factory();
        };
    }
}
