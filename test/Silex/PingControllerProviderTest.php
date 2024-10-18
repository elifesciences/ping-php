<?php

namespace test\eLife\Ping\Silex;

use eLife\Ping\PingController;
use eLife\Ping\Silex\PingControllerProvider;
use Silex\Application;

final class PingControllerProviderTest extends WebTestCase
{
    /** @var Application */
    protected $app;

    /**
     * @test
     */
    public function it_creates_a_service()
    {
        $this->assertArrayHasKey('ping.controller', $this->app);
        $this->assertInstanceOf(PingController::class, $this->app['ping.controller']);
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

    public function createApplication() : Application
    {
        $app = new Application();
        $app->register(new PingControllerProvider());

        $app['debug'] = true;
        unset($app['exception_handler']);

        $app->boot();
        $app->flush();

        return $app;
    }
}
