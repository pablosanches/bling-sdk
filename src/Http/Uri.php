<?php

declare(strict_types=1);

namespace PabloSanches\Bling\Http;

abstract class Uri
{
    private const BASE_URI = 'https://www.bling.com.br';
    private const ENDPOINT_PREFFIX = '/Api/v3';

    public static function fromPath(string $path, array $options = []): string
    {
        $params = '';
        if (!empty($options)) {
            $params = '?' . http_build_query($options);
        }
        return sprintf('%s%s%s%s', self::BASE_URI, self::ENDPOINT_PREFFIX, $path, $params);
    }

    public static function baseUri(): string
    {
        return self::BASE_URI;
    }
}
