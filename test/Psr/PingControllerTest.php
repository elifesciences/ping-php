<?php

namespace test\eLife\Ping\Psr;

use eLife\Ping\Psr\PingController;
use PHPUnit\Framework\TestCase;
use Nyholm\Psr7\Factory\Psr17Factory;

final class PingControllerTest extends TestCase
{
    /**
     * @test
     */
    public function it_returns_200_pong()
    {
        $factory = new Psr17Factory();
        $controller = new PingController(
            $factory,
            $factory
        );

        $response = $controller->handle($factory->createServerRequest('GET', '/ping'));

        $this->assertSame(200, $response->getStatusCode());
        $this->assertSame('text/plain; charset=UTF-8', $response->getHeaderLine('Content-Type'));
        $this->assertSame('pong', $response->getBody()->getContents());
        $this->assertSame('must-revalidate, no-cache, no-store, private', $response->getHeaderLine('Cache-Control'));
    }
}
