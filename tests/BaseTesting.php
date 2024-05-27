<?php

namespace PabloSanches\Bling;

use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;
use PabloSanches\Bling\Client as BlingClient;

class BaseTesting extends TestCase
{
    private string $token = 'fake-token';

    protected function getBlingClient(array $mockData, array $params = []): BlingClient
    {
        $response = $mockData['response'];
        $handlers = [];
        foreach ($response as $statusCode => $responseData) {
            $handlers[] = new Response($statusCode, ['Content-Type' => 'application/json'], json_encode($responseData));
        }
        $handlerStack = HandlerStack::create(new MockHandler($handlers));
        $client = new \GuzzleHttp\Client(['handler' => $handlerStack]);
        return BlingClient::factory($this->token, $params, $client);
    }

    protected function getMockFile($path)
    {
        $filepath = __DIR__ . '/Fixtures/' . $path;
        return json_decode(file_get_contents($filepath), true);
    }
}
