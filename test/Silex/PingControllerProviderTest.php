<?php

namespace test\eLife\Ping\Silex;

use Closure;
use eLife\Ping\PingController;
use eLife\Ping\Silex\PingControllerProvider;
use Exception;
use RuntimeException;
use Silex\Application;
use Silex\WebTestCase;
use Symfony\Component\Debug\BufferingLogger;
use Traversable;

final class PingControllerProviderTest extends WebTestCase
{
    /** @var Application */
    protected $app;

    /** @var Closure */
    protected $check;

    /**
     * @before
     */
    public function resetCheck()
    {
        $this->check = function () {
        };
    }

    /**
     * @test
     * @dataProvider serviceProvider
     */
    public function it_creates_a_service(string $id, string $type)
    {
        $this->assertArrayHasKey($id, $this->app);
        $this->assertInstanceOf($type, $this->app[$id]);
    }

    public function serviceProvider() : Traversable
    {
        $services = [
            'ping.check' => Closure::class,
            'ping.controller' => PingController::class,
        ];

        foreach ($services as $id => $type) {
            yield $id => [$id, $type];
        }
    }

    /**
     * @test
     */
    public function it_registers_a_route()
    {
        $this->assertSame('/ping', $this->app['url_generator']->generate('ping'));
    }

    /**
     * @test
     */
    public function it_responds()
    {
        $client = $this->createClient();

        $client->request('GET', '/ping');
        $response = $client->getResponse();

        $this->assertSame(200, $response->getStatusCode());
        $this->assertSame('pong', $response->getContent());
    }

    /**
     * @test
     */
    public function it_checks_and_logs()
    {
        $client = $this->createClient();

        $this->check = function () {
            throw new RuntimeException('Some exception');
        };

        $client->request('GET', '/ping');
        $response = $client->getResponse();

        $this->assertSame(500, $response->getStatusCode());
        $this->assertSame('Internal Server Error', $response->getContent());

        $this->assertCount(1, $this->app['ping.logger']->cleanLogs());
    }

    final public function createApplication() : Application
    {
        $app = new Application();
        $app->register(new PingControllerProvider());

        $app['debug'] = true;
        unset($app['exception_handler']);

        $app['ping.check'] = function () {
            return function () {
                call_user_func($this->check);
            };
        };

        $app['ping.logger'] = new BufferingLogger();

        $app->boot();
        $app->flush();

        return $app;
    }
}
