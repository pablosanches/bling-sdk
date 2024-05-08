<?php

declare(strict_types=1);

namespace PabloSanches\Bling\Http;

use PabloSanches\Bling\BaseTesting;
use PHPUnit\Framework\Attributes\TestDox;

class UriTest extends BaseTesting
{
    #[TestDox('Valida que a base uri da API está correta')]
    public function testBaseUri()
    {
        self::assertEquals('https://www.bling.com.br', Uri::baseUri());
    }

    #[TestDox('Construção de endpoint **sem** parâmetros')]
    public function testFromPathWithoutParams()
    {
        self::assertEquals('https://www.bling.com.br/Api/v3/test', Uri::fromPath('/test'));
    }

    #[TestDox('Construção de endpoint **com** parâmetros')]
    public function testFromPathWithParam()
    {
        self::assertEquals('https://www.bling.com.br/Api/v3/test?foo=bar', Uri::fromPath('/test', ['foo' => 'bar']));
    }
}
