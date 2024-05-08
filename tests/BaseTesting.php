<?php

namespace PabloSanches\Bling;

use PHPUnit\Framework\TestCase;
use PabloSanches\Bling\Client as BlingClient;

class BaseTesting extends TestCase
{
    private string $token = '601372c3b3f80525eacea11fef5e9b64393c7dde';

    protected function getBlingClient(): BlingClient
    {
        return BlingClient::factory($this->token);
    }

    protected function getPayload($path)
    {
        $filepath = __DIR__ . '/Fixtures/' . $path;
        return json_decode(file_get_contents($filepath), true);
    }
}
