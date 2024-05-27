<?php

namespace PabloSanches\Bling\Resource;

use PabloSanches\Bling\BaseTesting;
use PabloSanches\Bling\Client as BlingClient;
use PabloSanches\Bling\Resource\CategoriasProdutos\CategoriasProdutos;
use PHPUnit\Framework\Attributes\Depends;
use PHPUnit\Framework\Attributes\TestDox;

class CategoriasProdutosTest extends BaseTesting
{
    #[TestDox('Criando categoria (pai) de produto')]
    public function testCreateCategoriasProdutos(): int
    {
        $mockData = $this->getMockFile('categorias_produtos/criar.json');
        $blingClient = $this->getBlingClient($mockData);
        $response = $blingClient->categoriasProdutos()->criar($mockData['request']);
        self::assertEquals($response->getStatusCode(), 201);
        self::assertArrayHasKey('id', $response->getData());
        return $response->getData()['id'];
    }

    #[TestDox('Criando categoria (filha) de produto')]
    #[Depends('testCreateCategoriasProdutos')]
    public function testCreateCategoriasProdutosFilha(int $idPai): int
    {
        $mockData = $this->getMockFile('categorias_produtos/criar.json');
        $blingClient = $this->getBlingClient($mockData);
        $mockData['request']['categoriaPai'] = ['id' => $idPai];
        $response = $blingClient->categoriasProdutos()->criar($mockData['request']);
        self::assertEquals($response->getStatusCode(), 201);
        self::assertArrayHasKey('id', $response->getData());
        return $response->getData()['id'];
    }

    #[TestDox('Criando categoria (neta) de produto')]
    #[Depends('testCreateCategoriasProdutosFilha')]
    public function testCreateCategoriasProdutosNeta(int $idAvo): int
    {
        $mockData = $this->getMockFile('categorias_produtos/criar.json');
        $blingClient = $this->getBlingClient($mockData);
        $mockData['request']['categoriaPai'] = ['id' => $idAvo];
        $response = $blingClient->categoriasProdutos()->criar($mockData['request']);
        self::assertEquals($response->getStatusCode(), 201);
        self::assertArrayHasKey('id', $response->getData());
        return $response->getData()['id'];
    }

    #[TestDox('Atualizando categoria (neta) de produto')]
    #[Depends('testCreateCategoriasProdutosNeta')]
    public function testAtualizarCategoriasProdutos(int $idCategoria): int
    {
        $mockData = $this->getMockFile('categorias_produtos/atualizar.json');
        $blingClient = $this->getBlingClient($mockData);
        $response = $blingClient->categoriasProdutos()->atualizar($idCategoria, $mockData['request']);
        self::assertEquals($response->getStatusCode(), 204);
        return $idCategoria;
    }

    #[TestDox('Buscando categoria de produto pelo ID')]
    #[Depends('testCreateCategoriasProdutosNeta')]
    public function testBuscarCategoriasProdutos(int $idCategoria): void
    {
        $mockData = $this->getMockFile('categorias_produtos/buscar.json');
        $blingClient = $this->getBlingClient($mockData);
        $response = $blingClient->categoriasProdutos()->buscar($idCategoria);
        self::assertEquals($response->getStatusCode(), 200);
        self::assertEquals($idCategoria, $response->getData()['id']);
        self::assertEquals('Eletrônicos', $response->getData()['descricao']);
    }

    #[TestDox('Buscando todas as categorias de produtos cadastradas')]
    public function testBuscarTodasCategoriasProdutos(): array
    {
        $mockData = $this->getMockFile('categorias_produtos/buscar-todos.json');
        $blingClient = $this->getBlingClient($mockData);
        $response = $blingClient->categoriasProdutos()->buscarTodos();
        self::assertEquals($response->getStatusCode(), 200);
        self::assertNotEmpty($response->getData());
        return $response->getData();
    }

    #[TestDox('Removendo todas as categorias de produtos')]
    #[Depends('testBuscarTodasCategoriasProdutos')]
    public function testRemovendoTodasCategoriasProdutos(array $categorias): void
    {
        $mockData = $this->getMockFile('categorias_produtos/remover.json');
        $blingClient = $this->getBlingClient($mockData);

        /**
         * @var CategoriasProdutos
         */
        $categoriasProdutos = $blingClient->categoriasProdutos();
        $categorias = array_reverse($categorias);
        foreach ($categorias as $categoria) {
            $response = $categoriasProdutos->remover($categoria['id']);
            self::assertEquals($response->getStatusCode(), 204);
        }
    }
}
