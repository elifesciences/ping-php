<?php

namespace eLife\Ping\Psr;

use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\StreamFactoryInterface;

final class PingController
{
    /**
     * @var ResponseFactoryInterface
     */
    private $responseFactory;

    /**
     * @var StreamFactoryInterface
     */
    private $streamFactory;

    public function __construct(ResponseFactoryInterface $responseFactory, StreamFactoryInterface $streamFactory)
    {
        $this->responseFactory = $responseFactory;
        $this->streamFactory = $streamFactory;
    }

    public function pingAction() : Response
    {
        return $this->responseFactory->createResponse(200)
            ->withBody($this->streamFactory->createStream('pong'))
            ->withHeader('Cache-Control', 'must-revalidate, no-cache, no-store, private')
            ->withHeader('Content-Type', 'text/plain; charset=UTF-8');
    }
}
