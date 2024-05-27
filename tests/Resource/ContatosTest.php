<?php

namespace PabloSanches\Bling\Resource;

use PabloSanches\Bling\BaseTesting;
use PHPUnit\Framework\Attributes\Depends;
use PHPUnit\Framework\Attributes\TestDox;

class ContatosTest extends BaseTesting
{
    #[TestDox('Criação de contato')]
    public function testCreateContato(): int
    {
        $mockData = $this->getMockFile('contatos/criar-contato.json');
        $blingClient = $this->getBlingClient($mockData);
        $response = $blingClient->contatos()->criar($mockData['request']);
        self::assertEquals($response->getStatusCode(), 201);
        self::assertArrayHasKey('id', $response->getData());

        return $response->getData()['id'];
    }

    #[TestDox('Edição de contato')]
    #[Depends('testCreateContato')]
    public function testUpdate(int $id): void
    {
        $mockData = $this->getMockFile('contatos/alterar-contato.json');
        $blingClient = $this->getBlingClient($mockData);

        $response = $blingClient->contatos()->atualizar($id, $mockData['request']);
        self::assertEquals(204, $response->getStatusCode());
    }

    #[TestDox('Buscando todos os contatos')]
    public function testFetchAll(): void
    {
        $mockData = $this->getMockFile('contatos/buscar-todos-contatos.json');
        $blingClient = $this->getBlingClient($mockData);

        $response = $blingClient->contatos()->buscarTodos();
        self::assertEquals(200, $response->getStatusCode());
        self::assertGreaterThan(0, count($response->getData()));
    }

    #[TestDox('Buscando contato específico')]
    #[Depends('testCreateContato')]
    public function testFetchById(int $id): void
    {
        $mockData = $this->getMockFile('contatos/buscar-contato-id.json');
        $blingClient = $this->getBlingClient($mockData);

        $response = $blingClient->contatos()->buscar($id);
        self::assertEquals(200, $response->getStatusCode());
        self::assertEquals($id, $response->getData()['id']);
    }

    #[TestDox('Buscando tipos de contato específico')]
    #[Depends('testCreateContato')]
    public function testFetchTypeById(int $id): void
    {
        $mockData = $this->getMockFile('contatos/buscar-tipos-contato.json');
        $blingClient = $this->getBlingClient($mockData);

        $response = $blingClient->contatos()->buscarTipos($id);
        self::assertEquals(200, $response->getStatusCode());
        self::assertIsArray($response->getData());
    }

    #[TestDox('Buscando consumidores finais')]
    public function testFinalCustomers(): void
    {
        $mockData = $this->getMockFile('contatos/buscar-consumidores-finais.json');
        $blingClient = $this->getBlingClient($mockData);

        $response = $blingClient->contatos()->buscarConsumidoresFinais();
        self::assertEquals(200, $response->getStatusCode());
        self::assertIsArray($response->getData());
    }

    #[TestDox('Alterando situação de um contato')]
    #[Depends('testCreateContato')]
    public function testChangeStatus(int $id): void
    {
        $mockData = $this->getMockFile('contatos/atualizar-situacao-id.json');
        $blingClient = $this->getBlingClient($mockData);

        $response = $blingClient->contatos()->atualizarSituacao($id, 'I');
        self::assertEquals(204, $response->getStatusCode());
    }

    #[TestDox('Alterando situação de múltiplos contatos')]
    #[Depends('testCreateContato')]
    public function testChangeStatusMulti(int $id): void
    {
        $mockData = $this->getMockFile('contatos/atualizar-situacao-multiplos.json');
        $blingClient = $this->getBlingClient($mockData);

        $response = $blingClient
            ->contatos()
            ->alterarSituacoesMultiplos(
                [$id],
                'A'
            );
        self::assertEquals(204, $response->getStatusCode());
    }

    #[TestDox('Remove contato por id')]
    #[Depends('testCreateContato')]
    public function testRemoveById(int $id): void
    {
        $mockData = $this->getMockFile('contatos/remover-id.json');
        $blingClient = $this->getBlingClient($mockData);

        $response = $blingClient->contatos()->remover($id);
        self::assertEquals(204, $response->getStatusCode());
    }

    #[TestDox('Remover multiplos contatos')]
    public function testRemoveMultiple(): void
    {
        $mockData = $this->getMockFile('contatos/remover-multiplos.json');
        $blingClient = $this->getBlingClient($mockData);

        $response = $blingClient
            ->contatos()
            ->removerMultiplos([1, 2, 3]);
        self::assertEquals(204, $response->getStatusCode());
    }
}
