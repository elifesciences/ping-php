<?php

namespace eLife\Ping;

use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

final class PingController
{
    private $check;
    private $logger;

    public function __construct(callable $check = null, LoggerInterface $logger = null)
    {
        $this->check = $check;
        $this->logger = $logger;
    }

    public function pingAction() : Response
    {
        if ($this->check) {
            try {
                call_user_func($this->check);
            } catch (Throwable $e) {
                if ($this->logger) {
                    $this->logger->critical('Ping failed', ['exception' => $e]);
                }

                return $this->createResponse(Response::HTTP_INTERNAL_SERVER_ERROR);
            }
        }

        return $this->createResponse(Response::HTTP_OK, 'pong');
    }

    private function createResponse(int $statusCode, string $content = null) : Response
    {
        return new Response(
            $content ?? Response::$statusTexts[$statusCode],
            $statusCode,
            [
                'Cache-Control' => 'must-revalidate, no-cache, no-store, private',
                'Content-Type' => 'text/plain; charset=UTF-8',
            ]
        );
    }
}
