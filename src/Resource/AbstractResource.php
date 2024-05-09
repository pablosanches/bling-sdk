<?php

namespace PabloSanches\Bling\Resource;

use PabloSanches\Bling\Client as BlingClient;
use PabloSanches\Bling\Http\BlingResponse;
use PabloSanches\Bling\Http\HttpMethods;
use PabloSanches\Bling\Resource\Dto\DtoInterface;

abstract class AbstractResource implements ResourceInterface
{
    public function __construct(
        private readonly BlingClient $blingClient,
        private readonly array $params = []
    ) {
    }

    public function request(
        HttpMethods $method,
        string $endpoint,
        ?DtoInterface $requestBody = null,
        ?DtoInterface $query = null
    ): BlingResponse {
        $options = [];
        if (!empty($requestBody)) {
            $options['json'] = $requestBody->export();
        }

        if (!empty($query)) {
            $options['query'] = $query->export();
        }

        $response = $this->blingClient
            ->httpClient()
            ->request(
                $method->value,
                $endpoint,
                $options
            );

        return BlingResponse::factory($response);
    }
}
