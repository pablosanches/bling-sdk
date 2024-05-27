<?php

namespace PabloSanches\Bling\Resource;

use PabloSanches\Bling\BaseTesting;
use PHPUnit\Framework\Attributes\Depends;
use PHPUnit\Framework\Attributes\TestDox;

class CategoriasLojasTest extends BaseTesting
{
    #[TestDox('Criando um vínculo de categoria no bling')]
    public function testCreateCategoriasLojas(): int
    {
        $mockData = $this->getMockFile('categorias_lojas/criar.json');
        $blingClient = $this->getBlingClient($mockData, ['multilojas' => 123456789]);
        $response = $blingClient->categoriasLojas()->criar($mockData['request']);
        self::assertEquals(201, $response->getStatusCode());
        return $response->getData()['id'];
    }

    #[TestDox('Atualizando vinculo de categoria de multilojas')]
    #[Depends('testCreateCategoriasLojas')]
    public function testAtualizarCategoriasLojas(int $idVinculo)
    {
        $mockData = $this->getMockFile('categorias_lojas/atualizar.json');
        $blingClient = $this->getBlingClient($mockData, ['multilojas' => 123456789]);
        $response = $blingClient->categoriasLojas()->atualizar($idVinculo, $mockData['request']);
        self::assertEquals(204, $response->getStatusCode());
    }

    #[TestDox('Buscar vinculo de categoria de produtos do multilojas pelo seu ID')]
    #[Depends('testCreateCategoriasLojas')]
    public function testFetchCategoriasLojasById(int $idVinculo)
    {
        $mockData = $this->getMockFile('categorias_lojas/buscar.json');
        $blingClient = $this->getBlingClient($mockData, ['multilojas' => 123456789]);
        $response = $blingClient->categoriasLojas()->buscar($idVinculo);
        self::assertEquals(200, $response->getStatusCode());
        self::assertEquals($idVinculo, $response->getData()['id']);
    }

    #[TestDox('Buscando todos os vinculos de categorias do multilojas')]
    public function testFetchAllCategoriasLojas(): void
    {
        $mockData = $this->getMockFile('categorias_lojas/buscar-todos.json');
        $blingClient = $this->getBlingClient($mockData, ['multilojas' => 123456789]);
        $response = $blingClient->categoriasLojas()->buscarTodos();
        self::assertEquals(200, $response->getStatusCode());
        self::assertNotEmpty($response->getData());
    }

    #[TestDox('Buscando todos os vinculos de categorias do multilojas filtrando pelo id da categoria')]
    public function testFetchAllCategoriasLojasFilteringByCategoryId(): void
    {
        $mockData = $this->getMockFile('categorias_lojas/buscar-todos.json');
        $blingClient = $this->getBlingClient($mockData, ['multilojas' => 123456789]);
        $response = $blingClient->categoriasLojas()->buscarTodos([
            'idCategoriaProduto' => 9745408
        ]);
        self::assertEquals(200, $response->getStatusCode());
        self::assertNotEmpty($response->getData());
    }

    #[TestDox('Buscando todos os vinculos de categorias do multilojas filtrando pelo id do multilojas')]
    public function testFetchAllCategoriasLojasFilteringByMultilojas(): void
    {
        $mockData = $this->getMockFile('categorias_lojas/buscar-todos.json');
        $blingClient = $this->getBlingClient($mockData, ['multilojas' => 123456789]);
        $response = $blingClient->categoriasLojas()->buscarTodos([
            'idLoja' => $blingClient->getMultilojas()
        ]);
        self::assertEquals(200, $response->getStatusCode());
        self::assertNotEmpty($response->getData());
    }

    #[TestDox('Deletando o vinculo de uma categoria de produtos do multilojas')]
    #[Depends('testCreateCategoriasLojas')]
    public function testDeleteCategoryLink(int $idVinculo): void
    {
        $mockData = $this->getMockFile('categorias_lojas/remover.json');
        $blingClient = $this->getBlingClient($mockData, ['multilojas' => 123456789]);
        $response = $blingClient->categoriasLojas()->remover($idVinculo);
        self::assertEquals(204, $response->getStatusCode());
    }
}
