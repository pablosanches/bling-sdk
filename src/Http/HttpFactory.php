<?php

declare(strict_types=1);

namespace PabloSanches\Bling\Http;

use GuzzleHttp\Client;

class HttpFactory
{
    public static function factoryClient(string $token): Client
    {
        return new Client([
            'base_uri' => Uri::baseUri(),
            'timeout' => 30,
            'connect_timeout' => 30,
            'http_errors' => false,
            'headers' => [
                'Authorization' => 'Bearer ' . $token,
            ]
        ]);
    }
}
