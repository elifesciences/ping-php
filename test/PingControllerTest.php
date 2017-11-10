<?php

namespace test\eLife\Ping;

use eLife\Ping\PingController;
use Exception;
use PHPUnit\Framework\TestCase;
use Psr\Log\LogLevel;
use Symfony\Component\Debug\BufferingLogger;

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

    /**
     * @test
     */
    public function it_returns_200_pong_if_a_check_passes()
    {
        $controller = new PingController(function () {
        });

        $response = $controller->pingAction();

        $this->assertSame(200, $response->getStatusCode());
        $this->assertSame('text/plain; charset=UTF-8', $response->headers->get('Content-Type'));
        $this->assertSame('pong', $response->getContent());
        $this->assertFalse($response->isCacheable());
    }

    /**
     * @test
     */
    public function it_returns_500_if_a_check_fails()
    {
        $controller = new PingController(function () {
            throw new Exception('Some exception');
        });

        $response = $controller->pingAction();

        $this->assertSame(500, $response->getStatusCode());
        $this->assertSame('text/plain; charset=UTF-8', $response->headers->get('Content-Type'));
        $this->assertSame('Internal Server Error', $response->getContent());
        $this->assertFalse($response->isCacheable());
    }

    /**
     * @test
     */
    public function it_logs_if_a_check_fails()
    {
        $logger = new BufferingLogger();
        $exception = new Exception('Some exception');
        $controller = new PingController(function () use ($exception) {
            throw $exception;
        }, $logger);

        $controller->pingAction();

        $messages = $logger->cleanLogs();

        $this->assertCount(1, $messages);
        $this->assertSame([
            LogLevel::CRITICAL,
            'Ping failed',
            ['exception' => $exception],
        ], $messages[0]);
    }
}
