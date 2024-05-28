<?php

namespace PabloSanches\Bling\Resource;

use PabloSanches\Bling\BaseTesting;
use PHPUnit\Framework\Attributes\Depends;
use PHPUnit\Framework\Attributes\TestDox;

class EstoquesTest extends BaseTesting
{
    #[TestDox('Criar registro de estoque')]
    public function testCreateStockRegistry(): int
    {
        $mockData = $this->getMockFile('estoques/criar.json');
        $blingClient = $this->getBlingClient($mockData);
        $response = $blingClient->estoques()->criar($mockData['request']);
        self::assertEquals(201, $response->getStatusCode());
        self::assertNotEmpty($response->getData()['id']);
        return $response->getData()['id'];
    }

    #[TestDox('Atualizar registro de estoque')]
    #[Depends('testCreateStockRegistry')]
    public function testUpdateStockRegistry(int $stockId): void
    {
        $data = new \DateTimeImmutable();
        $mockData = $this->getMockFile('estoques/atualizar.json');
        $blingClient = $this->getBlingClient($mockData);
        $response = $blingClient->estoques()->atualizar($stockId, $mockData['request']);
        self::assertEquals(204, $response->getStatusCode());
    }

    #[TestDox('Buscar registro de estoque')]
    #[Depends('testCreateStockRegistry')]
    public function testFetchStockRegistry(int $stockId): void
    {
        $mockData = $this->getMockFile('estoques/buscar-por-deposito.json');
        $blingClient = $this->getBlingClient($mockData);
        $response = $blingClient->estoques()->buscarPorDeposito($mockData['filter']);
        self::assertEquals(200, $response->getStatusCode());
        self::assertNotEmpty($response->getData());
    }

    #[TestDox('Buscar todos os registro de estoque')]
    public function testFetchAllStockRegistry(): void
    {
        $mockData = $this->getMockFile('estoques/buscar-todos.json');
        $blingClient = $this->getBlingClient($mockData);
        $response = $blingClient->estoques()->buscarTodos($mockData['filter']);
        self::assertEquals(200, $response->getStatusCode());
        self::assertNotEmpty($response->getData());
    }
}
