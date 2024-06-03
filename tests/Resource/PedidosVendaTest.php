<?php

namespace PabloSanches\Bling\Resource;

use PabloSanches\Bling\BaseTesting;
use PHPUnit\Framework\Attributes\Depends;
use PHPUnit\Framework\Attributes\TestDox;

class PedidosVendaTest extends BaseTesting
{
    #[TestDox('Criando um pedido de venda')]
    public function testCreateOrder(): int
    {
        $mockData = $this->getMockFile('pedidos_vendas/criar.json');
        $blingClient = $this->getBlingClient($mockData);
        $response = $blingClient->pedidosVendas()->criar($mockData['request']);
        self::assertEquals(201, $response->getStatusCode());
        self::assertNotEmpty($response->getData()['id']);
        return $response->getData()['id'];
    }

    #[TestDox('Atualizando um pedido de venda')]
    #[Depends('testCreateOrder')]
    public function testUpdateOrder(int $pedidoVendaId): void
    {
        $mockData = $this->getMockFile('pedidos_vendas/atualizar.json');
        $blingClient = $this->getBlingClient($mockData);
        $response = $blingClient->pedidosVendas()->atualizar($pedidoVendaId, $mockData['request']);
        self::assertEquals(200, $response->getStatusCode());
        self::assertEquals($pedidoVendaId, $response->getData()['id']);
    }

    #[TestDox('Removendo um pedido de venda')]
    #[Depends('testCreateOrder')]
    public function testRemove(int $pedidoVendaId): void
    {
        $mockData = $this->getMockFile('pedidos_vendas/remover.json');
        $blingClient = $this->getBlingClient($mockData);
        $response = $blingClient->pedidosVendas()->remover($pedidoVendaId);
        self::assertEquals(204, $response->getStatusCode());
    }

    #[TestDox('Remover múltiplos pedidos de venda')]
    #[Depends('testCreateOrder')]
    public function testRemoveMultiple(int $pedidoVendaId): void
    {
        $mockData = $this->getMockFile('pedidos_vendas/remover-multiplos.json');
        $blingClient = $this->getBlingClient($mockData);
        $response = $blingClient->pedidosVendas()->removerMultiplos([$pedidoVendaId]);
        self::assertEquals(204, $response->getStatusCode());
    }

    #[TestDox('Obter pedido de venda')]
    #[Depends('testCreateOrder')]
    public function testFetchOrder(int $pedidoVendaId): void
    {
        $mockData = $this->getMockFile('pedidos_vendas/buscar.json');
        $blingClient = $this->getBlingClient($mockData);
        $response = $blingClient->pedidosVendas()->buscar($pedidoVendaId);
        self::assertEquals(200, $response->getStatusCode());
        self::assertEquals($pedidoVendaId, $response->getData()['id']);
    }

    #[TestDox('Obter pedido de venda')]
    public function testFetchAllOrders(): void
    {
        $mockData = $this->getMockFile('pedidos_vendas/buscar-todos.json');
        $blingClient = $this->getBlingClient($mockData);
        $response = $blingClient->pedidosVendas()->buscarTodos();
        self::assertEquals(200, $response->getStatusCode());
        self::assertNotEmpty($response->getData());
    }

    #[TestDox('Alterar situação de um pedido de venda')]
    #[Depends('testCreateOrder')]
    public function testChangeOrderSituation(int $pedidoVendaId): void
    {
        $mockData = $this->getMockFile('pedidos_vendas/alterar-situacao.json');
        $blingClient = $this->getBlingClient($mockData);
        $idSituacao = 123456789;
        $response = $blingClient->pedidosVendas()->alterarSituacao($pedidoVendaId, $idSituacao);
        self::assertEquals(204, $response->getStatusCode());
    }

    #[TestDox('Lançar estoque de um pedido de venda para um depósito em específico')]
    #[Depends('testCreateOrder')]
    public function testLaunchStockFromSpecificDeposit(int $pedidoVendaId): void
    {
        $mockData = $this->getMockFile('pedidos_vendas/lancar-estoque-deposito.json');
        $blingClient = $this->getBlingClient($mockData);
        $idDeposito = 123456789;
        $response = $blingClient->pedidosVendas()->lancaEstoquePorDeposito($pedidoVendaId, $idDeposito);
        self::assertEquals(204, $response->getStatusCode());
    }

    #[TestDox('Lançar estoque de um pedido de venda')]
    #[Depends('testCreateOrder')]
    public function testLaunchStock(int $pedidoVendaId): void
    {
        $mockData = $this->getMockFile('pedidos_vendas/lancar-estoque.json');
        $blingClient = $this->getBlingClient($mockData);
        $response = $blingClient->pedidosVendas()->lancarEstoque($pedidoVendaId);
        self::assertEquals(204, $response->getStatusCode());
    }

    #[TestDox('Estornar de um pedido de venda')]
    #[Depends('testCreateOrder')]
    public function testReverseStock(int $pedidoVendaId): void
    {
        $mockData = $this->getMockFile('pedidos_vendas/estornar-estoque.json');
        $blingClient = $this->getBlingClient($mockData);
        $response = $blingClient->pedidosVendas()->estornarEstoque($pedidoVendaId);
        self::assertEquals(204, $response->getStatusCode());
    }

    #[TestDox('Lançar contas de um pedido de vendas')]
    #[Depends('testCreateOrder')]
    public function testPublishAccounts(int $pedidoVendaId): void
    {
        $mockData = $this->getMockFile('pedidos_vendas/lancar-contas.json');
        $blingClient = $this->getBlingClient($mockData);
        $response = $blingClient->pedidosVendas()->lancarContas($pedidoVendaId);
        self::assertEquals(204, $response->getStatusCode());
    }

    #[TestDox('Estornar contas de um pedido de vendas')]
    #[Depends('testCreateOrder')]
    public function testReversePublishAccounts(int $pedidoVendaId): void
    {
        $mockData = $this->getMockFile('pedidos_vendas/estornar-contas.json');
        $blingClient = $this->getBlingClient($mockData);
        $response = $blingClient->pedidosVendas()->estornarContas($pedidoVendaId);
        self::assertEquals(204, $response->getStatusCode());
    }

    #[TestDox('Gerar NFE')]
    #[Depends('testCreateOrder')]
    public function testGenerateNFE(int $pedidoVendaId): void
    {
        $mockData = $this->getMockFile('pedidos_vendas/gerar-nfe.json');
        $blingClient = $this->getBlingClient($mockData);
        $response = $blingClient->pedidosVendas()->gerarNfe($pedidoVendaId);
        self::assertEquals(204, $response->getStatusCode());
    }

    #[TestDox('Gerar NFCE')]
    #[Depends('testCreateOrder')]
    public function testGenerateNFCE(int $pedidoVendaId): void
    {
        $mockData = $this->getMockFile('pedidos_vendas/gerar-nfce.json');
        $blingClient = $this->getBlingClient($mockData);
        $response = $blingClient->pedidosVendas()->gerarNfce($pedidoVendaId);
        self::assertEquals(204, $response->getStatusCode());
    }
}
