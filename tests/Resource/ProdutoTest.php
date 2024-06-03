<?php

namespace PabloSanches\Bling\Resource;

use PabloSanches\Bling\BaseTesting;
use PabloSanches\Bling\Client;
use PHPUnit\Framework\Attributes\Depends;
use PHPUnit\Framework\Attributes\TestDox;

class ProdutoTest extends BaseTesting
{
    #[TestDox('Criando um novo produto')]
    public function testCreateProduct(): int
    {
        $mockData = $this->getMockFile('produtos/criar.json');
        $blingClient = $this->getBlingClient($mockData);
        $response = $blingClient->produtos()->criar($mockData['request']);
        self::assertEquals(201, $response->getStatusCode());
        self::assertNotEmpty($response->getData()['id']);
        return 16266663825;
//        return $response->getData()['id'];
    }

    #[TestDox('Criando um novo produto')]
    #[Depends('testCreateProduct')]
    public function testUpdateProduct(int $produtoId): void
    {
        $mockData = $this->getMockFile('produtos/atualizar.json');
        $mockData['request']['id'] = $produtoId;
        $mockData['request']['code'] = uniqid('TEST', true);
        $blingClient = $this->getBlingClient($mockData);
        $response = $blingClient->produtos()->atualizar($produtoId, $mockData['request']);
        self::assertEquals(200, $response->getStatusCode());
        self::assertEquals($produtoId, $response->getData()['id']);
    }

    #[TestDox('Alterando situação de múltiplos produtos')]
    #[Depends('testCreateProduct')]
    public function testChangeMultipleProductSituation(int $productId): void
    {
        $mockData = $this->getMockFile('produtos/alterar-situacao-multiplos-produtos.json');
        $blingClient = $this->getBlingClient($mockData);
        $response = $blingClient->produtos()->alterarSituacaoMultiplosProdutos(
            $mockData['request']['idsProdutos'],
            $mockData['request']['situacao']
        );
        self::assertEquals(204, $response->getStatusCode());
    }

    #[TestDox('Alterando situação de um produto')]
    #[Depends('testCreateProduct')]
    public function testChangeProductSituation(int $productId): void
    {
        $mockData = $this->getMockFile('produtos/alterar-situacao-produto.json');
        $blingClient = $this->getBlingClient($mockData);
        $response = $blingClient->produtos()->alterarSituacaoProduto(
            $mockData['request']['idProduto'],
            $mockData['request']['situacao']
        );
        self::assertEquals(204, $response->getStatusCode());
    }

    #[TestDox('Buscando produto pelo seu ID')]
    #[Depends('testCreateProduct')]
    public function testFetchProductById(int $productId): void
    {
        $mockData = $this->getMockFile('produtos/buscar-produto-id.json');
        $blingClient = $this->getBlingClient($mockData);
        $response = $blingClient->produtos()->buscar($productId);
        self::assertEquals(200, $response->getStatusCode());
        self::assertNotEmpty($response->getData()['id']);
        self::assertEquals($productId, $response->getData()['id']);
    }

    #[TestDox('Buscando todos os produtos')]
    public function testFetchAllProducts(): void
    {
        $mockData = $this->getMockFile('produtos/buscar-todos.json');
        $blingClient = $this->getBlingClient($mockData);
        $response = $blingClient->produtos()->buscarTodos();
        self::assertEquals(200, $response->getStatusCode());
        self::assertNotEmpty($response->getData());
    }

    #[TestDox('Removendo produto pelo ID')]
    #[Depends('testCreateProduct')]
    public function testRemoveProductById(int $productId): void
    {
        $mockData = $this->getMockFile('produtos/remover-id.json');
        $blingClient = $this->getBlingClient($mockData);
        $response = $blingClient->produtos()->remover($productId);
        self::assertEquals(204, $response->getStatusCode());
    }

    #[TestDox('Removendo múltiplos produtos')]
    #[Depends('testCreateProduct')]
    public function testRemoveMultipleProductsById(int $productId): void
    {
        $mockData = $this->getMockFile('produtos/remover-multiplos.json');
        $blingClient = $this->getBlingClient($mockData);
        $response = $blingClient->produtos()->removerMultiplos([$productId]);
        self::assertEquals(204, $response->getStatusCode());
    }
}
