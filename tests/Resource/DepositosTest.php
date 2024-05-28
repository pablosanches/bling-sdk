<?php

namespace PabloSanches\Bling\Resource;

use PabloSanches\Bling\BaseTesting;
use PHPUnit\Framework\Attributes\Depends;
use PHPUnit\Framework\Attributes\TestDox;

class DepositosTest extends BaseTesting
{
    #[TestDox('Criando depósito')]
    public function testCreateDeposit(): int
    {
        $mockData = $this->getMockFile('depositos/criar.json');
        $blingClient = $this->getBlingClient($mockData);
        $response = $blingClient->depositos()->criar($mockData['request']);
        self::assertEquals(201, $response->getStatusCode());
        self::assertNotEmpty($response->getData()['id']);
        return $response->getData()['id'];
    }

    #[TestDox('Atualizando depósito')]
    #[Depends('testCreateDeposit')]
    public function testUpdateDeposit(int $depositId): void
    {
        $mockData = $this->getMockFile('depositos/atualizar.json');
        $blingClient = $this->getBlingClient($mockData);
        $response = $blingClient->depositos()->atualizar($depositId, $mockData['request']);
        self::assertEquals(200, $response->getStatusCode());
        self::assertEquals($depositId, $response->getData()['id']);
    }

    #[TestDox('Buscando depósito pelo seu ID')]
    #[Depends('testCreateDeposit')]
    public function testFetchDeposit(int $depositId): void
    {
        $mockData = $this->getMockFile('depositos/buscar.json');
        $blingClient = $this->getBlingClient($mockData);
        $response = $blingClient->depositos()->buscar($depositId);
        self::assertEquals(200, $response->getStatusCode());
        self::assertNotEmpty($response->getData()['id']);
    }

    public function testFetchAllDeposits(): void
    {
        $mockData = $this->getMockFile('depositos/buscar-todos.json');
        $blingClient = $this->getBlingClient($mockData);
        $response = $blingClient->depositos()->buscarTodos();
        self::assertEquals(200, $response->getStatusCode());
        self::assertNotEmpty($response->getData());
    }
}
