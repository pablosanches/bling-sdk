<?php

namespace PabloSanches\Bling\Resource;

use PabloSanches\Bling\BaseTesting;
use PabloSanches\Bling\Client as BlingClient;
use PabloSanches\Bling\Resource\Contatos\Contatos;
use PHPUnit\Framework\Attributes\TestDox;

class ResourceFactoryTest extends BaseTesting
{
    #[TestDox('Construir namespace de resource não implementado deve disparar um \DomainException')]
    public function testResourceNamespace(): void
    {
        self::expectException(\DomainException::class);
        self::expectExceptionMessage('Resource "PabloSanches\Bling\Resource\NaoExiste\NaoExiste" não existe.');
        $nonExist = ResourceFactory::resourceNamespace('nao_existe');
    }

    #[TestDox('Construir namespace de resource válido')]
    public function testResourceClass(): void
    {
        $contatos = ResourceFactory::resourceNamespace('contatos');
        self::assertEquals(Contatos::class, $contatos);
    }

    #[TestDox('Factory de resource')]
    public function testResourceFactory(): void
    {
        $blingClient = BlingClient::factory('fake-token');
        $contatos = ResourceFactory::factory($blingClient, 'contatos');
        self::assertInstanceOf(Contatos::class, $contatos);
    }
}