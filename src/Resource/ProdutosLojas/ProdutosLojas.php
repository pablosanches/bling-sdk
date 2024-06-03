<?php

namespace PabloSanches\Bling\Resource\ProdutosLojas;

use PabloSanches\Bling\Http\BlingResponse;
use PabloSanches\Bling\Http\HttpMethods;
use PabloSanches\Bling\Http\Uri;
use PabloSanches\Bling\Resource\AbstractResource;
use PabloSanches\Bling\Resource\ProdutosLojas\Dto\FiltrosBuscaDto;
use PabloSanches\Bling\Resource\ProdutosLojas\Dto\PersistirProdutoLojasRequestDto;

class ProdutosLojas extends AbstractResource
{
    public function criar(array $payload): BlingResponse
    {
        $requestDto = PersistirProdutoLojasRequestDto::factory($payload);
        return $this->request(
            HttpMethods::POST,
            Uri::fromPath('/produtos/lojas'),
            $requestDto
        );
    }

    public function atualizar(int $id, array $payload): BlingResponse
    {
        $requestDto = PersistirProdutoLojasRequestDto::factory($payload);
        return $this->request(
            HttpMethods::PUT,
            Uri::fromPath("/produtos/lojas/{$id}"),
            $requestDto
        );
    }

    public function remover(int $id): BlingResponse
    {
        return $this->request(
            HttpMethods::DELETE,
            Uri::fromPath("/produtos/lojas/{$id}")
        );
    }

    public function buscar(int $id): BlingResponse
    {
        return $this->request(
            HttpMethods::GET,
            Uri::fromPath("/produtos/lojas/{$id}")
        );
    }

    public function buscarTodos(array $options = []): BlingResponse
    {
        $queryDto = FiltrosBuscaDto::factory($options);
        return $this->request(
            HttpMethods::GET,
            Uri::fromPath("/produtos/lojas"),
            $queryDto
        );
    }
}
