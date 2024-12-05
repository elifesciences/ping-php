<?php

namespace test\eLife\Ping\Pimple;

use eLife\Ping\PingController;
use eLife\Ping\Pimple\PingControllerProvider;
use PHPUnit\Framework\TestCase;
use Pimple\Container;

final class PingControllerProviderTest extends TestCase
{
    /** @var Container */
    protected $container;

    /**
     * @test
     */
    public function it_creates_a_service()
    {
        $this->assertArrayHasKey('ping.controller', $this->container);
        $this->assertInstanceOf(PingController::class, $this->container['ping.controller']);
    }

    protected function setup(): void
    {
        $this->container = new Container();
        $this->container->register(new PingControllerProvider());
    }
}
