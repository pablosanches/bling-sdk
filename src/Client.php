<?php

namespace PabloSanches\Bling;

use PabloSanches\Bling\Http\HttpFactory;
use PabloSanches\Bling\Resource\ResourceFactory;
use PabloSanches\Bling\Resource\ResourceInterface;
use GuzzleHttp\Client as HttpClient;

readonly class Client
{
    protected function __construct(
        protected readonly string $token,
        protected HttpClient $httpClient,
        protected readonly array $params
    ) {
    }

    public static function factory(
        string $token,
        ?HttpClient $httpClient = null,
        array $params = []
    ): self {
        if ($httpClient === null) {
            $httpClient = HttpFactory::factoryClient($token);
        }
        return new self($token, $httpClient, $params);
    }

    public function httpClient(): HttpClient
    {
        return $this->httpClient;
    }

    public function __call(string $resourceName, array $arguments = []): ResourceInterface
    {
        return ResourceFactory::factory($this, $resourceName, $arguments);
    }
}
