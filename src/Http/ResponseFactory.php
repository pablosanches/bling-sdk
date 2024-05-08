<?php

namespace PabloSanches\Bling\Http;

use PabloSanches\Bling\Http\Dto\ErrorResponseDto;
use PabloSanches\Bling\Http\Dto\SuccessResponseDto;
use PabloSanches\Bling\Resource\Dto\DtoInterface;
use Psr\Http\Message\ResponseInterface;

abstract class ResponseFactory
{
    public static function fromResponse(ResponseInterface $response): DtoInterface
    {
        exit(var_dump($response->getBody()->getContents()));
        $body = json_decode($response->getBody()->getContents(), true);
        if ($response->getStatusCode() >= 200 && $response->getStatusCode() < 300) {
            return SuccessResponseDto::factory(['data' => $body['data']]);
        }
        return ErrorResponseDto::factory(['error' => $body['error']]);
    }
}
