<?php

namespace PabloSanches\Bling\Http;

use GuzzleHttp\Client;
use PabloSanches\Bling\BaseTesting;
use PHPUnit\Framework\Attributes\TestDox;

class HttpFactoryTest extends BaseTesting
{
    #[TestDox('Valida o factory de client http')]
    public function testFactoryHttpClient()
    {
        $client = HttpFactory::factoryClient('fake-token');
        self::assertInstanceOf(Client::class, $client);
        self::assertSame(Uri::baseUri(), (string) $client->getConfig('base_uri'));
        self::assertSame('Bearer fake-token', $client->getConfig('headers')['Authorization']);
    }
}