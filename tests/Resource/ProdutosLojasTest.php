<?php

namespace PabloSanches\Bling\Resource;

use PabloSanches\Bling\BaseTesting;
use PabloSanches\Bling\Client;
use PHPUnit\Framework\Attributes\Depends;
use PHPUnit\Framework\Attributes\TestDox;

class ProdutosLojasTest extends BaseTesting
{
    public function getBling()
    {
        return Client::factory('7cd13bf440c4e9eae70fed0fdabe1a6bd791a224');
    }

    #[TestDox('Criando vínculo de multilojas de um produto')]
    public function testCreateProductLink(): int
    {
        $mockData = $this->getMockFile('produtos_lojas/criar.json');
        $blingClient = $this->getBlingClient($mockData);
        $response = $blingClient->produtosLojas()->criar($mockData['request']);
        self::assertEquals(201, $response->getStatusCode());
        self::assertNotEmpty($response->getData()['id']);
        return $response->getData()['id'];
    }

    #[TestDox('Criando vínculo de multilojas de um produto')]
    #[Depends('testCreateProductLink')]
    public function testUpdateProductLink(int $produtoLojaId): void
    {
        $mockData = $this->getMockFile('produtos_lojas/atualizar.json');
        $blingClient = $this->getBlingClient($mockData);
        $response = $blingClient->produtosLojas()->atualizar($produtoLojaId, $mockData['request']);
        self::assertEquals(200, $response->getStatusCode());
        self::assertNotEmpty($response->getData()['id']);
    }

    #[TestDox('Buscando vínculo de multilojas de um produto')]
    #[Depends('testCreateProductLink')]
    public function testFetchProductLink(int $produtoLojaId): void
    {
        $mockData = $this->getMockFile('produtos_lojas/buscar.json');
        $blingClient = $this->getBlingClient($mockData);
        $response = $blingClient->produtosLojas()->buscar($produtoLojaId);
        self::assertEquals(200, $response->getStatusCode());
        self::assertNotEmpty($response->getData()['id']);
        self::assertEquals($produtoLojaId, $response->getData()['id']);
    }

    #[TestDox('Buscando todos os produtos vinculados no multilojas')]
    public function testFetchAllProductLinks(): void
    {
        $mockData = $this->getMockFile('produtos_lojas/buscar-todos.json');
        $blingClient = $this->getBlingClient($mockData);
        $response = $blingClient->produtosLojas()->buscarTodos();
        self::assertEquals(200, $response->getStatusCode());
        self::assertNotEmpty($response->getData());
    }

    #[TestDox('Removendo vinculo de produto no multilojas')]
    #[Depends('testCreateProductLink')]
    public function testRemoveProductLink(int $produtoLojaId): void
    {
        $mockData = $this->getMockFile('produtos_lojas/remover.json');
        $blingClient = $this->getBlingClient($mockData);
        $response = $blingClient->produtosLojas()->remover($produtoLojaId);
        self::assertEquals(204, $response->getStatusCode());
    }
}
