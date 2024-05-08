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
            'timeout' => 5.0,
            'http_errors' => false,
            'headers' => [
                'Authorization' => 'Bearer ' . $token,
            ]
        ]);
    }
}
