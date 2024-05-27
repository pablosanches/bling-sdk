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
        protected readonly array $params,
        protected HttpClient $httpClient
    ) {
    }

    public static function factory(
        string $token,
        array $params = [],
        ?HttpClient $httpClient = null
    ): self {
        if ($httpClient === null) {
            $httpClient = HttpFactory::factoryClient($token);
        }
        return new self($token, $params, $httpClient);
    }

    public function httpClient(): HttpClient
    {
        return $this->httpClient;
    }

    public function getMultilojas(): ?string
    {
        return $this->params['multilojas'] ?? null;
    }


    public function __call(string $resourceName, array $arguments = []): ResourceInterface
    {
        return ResourceFactory::factory($this, $resourceName, $arguments);
    }
}
