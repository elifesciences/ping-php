<?php

namespace test\eLife\Ping;

use eLife\Ping\PingController;
use PHPUnit\Framework\TestCase;

final class PingControllerTest extends TestCase
{
    /**
     * @test
     */
    public function it_returns_200_pong()
    {
        $controller = new PingController();

        $response = $controller->pingAction();

        $this->assertSame(200, $response->getStatusCode());
        $this->assertSame('text/plain; charset=UTF-8', $response->headers->get('Content-Type'));
        $this->assertSame('pong', $response->getContent());
        $this->assertFalse($response->isCacheable());
    }
}
