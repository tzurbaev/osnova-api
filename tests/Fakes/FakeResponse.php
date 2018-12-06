<?php

namespace Osnova\Tests\Fakes;

use GuzzleHttp\Psr7\Response;

class FakeResponse
{
    public static function make($body = null, int $status = 200, array $headers = [])
    {
        return new Response($status, $headers, $body ?? json_encode(['result' => []]));
    }

    public static function makeJson($data, int $status = 200, array $headers = [])
    {
        $body = is_string($data) ? $data : json_encode($data);

        return static::make($body, $status, array_merge($headers, ['Content-Type' => 'application/json']));
    }
}
