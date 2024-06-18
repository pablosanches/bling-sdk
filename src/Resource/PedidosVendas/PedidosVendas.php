<?php

namespace PabloSanches\Bling\Resource\PedidosVendas;

use PabloSanches\Bling\Http\BlingResponse;
use PabloSanches\Bling\Http\HttpMethods;
use PabloSanches\Bling\Http\Uri;
use PabloSanches\Bling\Resource\AbstractResource;
use PabloSanches\Bling\Resource\PedidosVendas\Dto\PersistirPedidoVendaDto;

class PedidosVendas extends AbstractResource
{
    public function criar(array $payload): BlingResponse
    {
        $requestDto = PersistirPedidoVendaDto::factory($payload);
        return $this->request(
            HttpMethods::POST,
            Uri::fromPath('/pedidos/vendas'),
            $requestDto
        );
    }

    public function atualizar(int $id, array $payload): BlingResponse
    {
        $requestDto = PersistirPedidoVendaDto::factory($payload);
        return $this->request(
            HttpMethods::PUT,
            Uri::fromPath("/pedidos/vendas/{$id}"),
            $requestDto
        );
    }

    public function remover(int $id): BlingResponse
    {
        return $this->request(
            HttpMethods::DELETE,
            Uri::fromPath("/pedidos/vendas/{$id}")
        );
    }

    public function buscar(int $id): BlingResponse
    {
        return $this->request(
            HttpMethods::GET,
            Uri::fromPath("/pedidos/vendas/{$id}")
        );
    }

    public function buscarTodos(array $options = []): BlingResponse
    {
        return $this->request(
            HttpMethods::GET,
            Uri::fromPath('/pedidos/vendas', $options)
        );
    }

    public function lancaEstoquePorDeposito(int $id, int $idDeposito): BlingResponse
    {
        return $this->request(
            HttpMethods::POST,
            Uri::fromPath("/pedidos/vendas/{$id}/lancar-estoque/{$idDeposito}")
        );
    }

    public function lancarEstoque(int $id): BlingResponse
    {
        return $this->request(
            HttpMethods::POST,
            Uri::fromPath("/pedidos/vendas/{$id}/lancar-estoque")
        );
    }

    public function estornarEstoque(int $id): BlingResponse
    {
        return $this->request(
            HttpMethods::POST,
            Uri::fromPath("/pedidos/vendas/{$id}/estornar-estoque")
        );
    }

    public function lancarContas(int $id): BlingResponse
    {
        return $this->request(
            HttpMethods::POST,
            Uri::fromPath("/pedidos/vendas/{$id}/lancar-contas")
        );
    }

    public function estornarContas(int $id): BlingResponse
    {
        return $this->request(
            HttpMethods::POST,
            Uri::fromPath("/pedidos/vendas/{$id}/estornar-contas")
        );
    }

    public function gerarNfe(int $id): BlingResponse
    {
        return $this->request(
            HttpMethods::POST,
            Uri::fromPath("/pedidos/vendas/{$id}/gerar-nfe")
        );
    }

    public function gerarNfce(int $id): BlingResponse
    {
        return $this->request(
            HttpMethods::POST,
            Uri::fromPath("/pedidos/vendas/{$id}/gerar-nfce")
        );
    }

    public function alterarSituacao(int $id, int $idSituacao): BlingResponse
    {
        return $this->request(
            HttpMethods::PATCH,
            Uri::fromPath("/pedidos/vendas/{$id}/situacoes/{$idSituacao}")
        );
    }

    public function removerMultiplos(array $idsPedidos): BlingResponse
    {
        return $this->request(
            HttpMethods::DELETE,
            Uri::fromPath("/pedidos/vendas", ['idsPedidosVendas' => $idsPedidos])
        );
    }
}
