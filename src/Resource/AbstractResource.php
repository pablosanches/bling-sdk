<?php

declare(strict_types=1);

namespace PabloSanches\Bling\Resource;

use PabloSanches\Bling\Client as BlingClient;
use PabloSanches\Bling\Http\HttpMethods;
use PabloSanches\Bling\Http\ResponseFactory;
use PabloSanches\Bling\Http\Uri;
use PabloSanches\Bling\Resource\Dto\DtoInterface;
use PabloSanches\Bling\Resource\Dto\ResponseErrorDto;
use Psr\Http\Message\ResponseInterface;

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
    ): DtoInterface {
        $query = is_a($query, DtoInterface::class) ? $query->export() : [];
        $options = [];
        if (!empty($requestBody)) {
            $options['json'] = $requestBody->export();
        }

        $response = $this->blingClient
            ->httpClient()
            ->request(
                $method->value,
                Uri::fromPath($endpoint, $query),
                $options
            );
        return ResponseFactory::fromResponse($response);
    }
}
