<?php

namespace eLife\Ping;

use Symfony\Component\HttpFoundation\Response;

final class PingController
{
    public function pingAction() : Response
    {
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
