<?php

namespace test\eLife\Ping\Symfony;

use eLife\Ping\PingController;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use test\eLife\Ping\Symfony\App\AppKernel;

final class PingBundleTest extends WebTestCase
{
    /**
     * @test
     */
    public function it_creates_a_service()
    {
        $this->bootKernel();

        $this->assertTrue(static::$kernel->getContainer()->has('ping.controller'));
        $this->assertInstanceOf(PingController::class, static::$kernel->getContainer()->get('ping.controller'));
    }

    /**
     * @test
     */
    public function it_registers_a_route()
    {
        $this->bootKernel();

        $this->assertSame('/ping', static::$kernel->getContainer()->get('router')->generate('ping'));
    }

    /**
     * @test
     */
    public function test()
    {
        $client = $this->createClient();

        $client->request('GET', '/ping');
        $response = $client->getResponse();

        $this->assertSame(200, $response->getStatusCode());
        $this->assertSame('pong', $response->getContent());
    }

    protected static function getKernelClass() : string
    {
        return AppKernel::class;
    }
}
