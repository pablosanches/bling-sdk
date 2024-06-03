<?php

namespace PabloSanches\Bling\Resource\Produtos;

use PabloSanches\Bling\Http\BlingResponse;
use PabloSanches\Bling\Http\HttpMethods;
use PabloSanches\Bling\Http\Uri;
use PabloSanches\Bling\Resource\AbstractResource;
use PabloSanches\Bling\Resource\Dto\FiltersDto;
use PabloSanches\Bling\Resource\Produtos\Dto\AlteraSituacaoProdutoDto;
use PabloSanches\Bling\Resource\Produtos\Dto\PersistirProdutoRequestDto;

class Produtos extends AbstractResource
{
    public function criar(array $payload): BlingResponse
    {
        $requestDto = PersistirProdutoRequestDto::factory($payload);
        return $this->request(
            HttpMethods::POST,
            Uri::fromPath('/produtos'),
            $requestDto
        );
    }

    public function atualizar(int $id, array $payload): BlingResponse
    {
        $requestDto = PersistirProdutoRequestDto::factory($payload);
        return $this->request(
            HttpMethods::PUT,
            Uri::fromPath("/produtos/{$id}"),
            $requestDto
        );
    }

    public function remover(int $id): BlingResponse
    {
        return $this->request(
            HttpMethods::DELETE,
            Uri::fromPath("/produtos/{$id}")
        );
    }

    public function removerMultiplos(array $idsProdutos): BlingResponse
    {
        return $this->request(
            HttpMethods::DELETE,
            Uri::fromPath(
                "/produtos",
                [
                    'idsProdutos' => $idsProdutos
                ]
            )
        );
    }

    public function buscar(int $id): BlingResponse
    {
        return $this->request(
            HttpMethods::GET,
            Uri::fromPath("/produtos/{$id}")
        );
    }

    public function buscarTodos(array $options = []): BlingResponse
    {
        $queryDto = FiltersDto::factory($options);
        return $this->request(
            HttpMethods::GET,
            Uri::fromPath('/produtos'),
            $queryDto
        );
    }

    public function alterarSituacaoProduto(int $id, string $situacao): BlingResponse
    {
        $requestDto = AlteraSituacaoProdutoDto::factory(['situacao' => $situacao]);
        return $this->request(
            HttpMethods::PATCH,
            Uri::fromPath("/produtos/{$id}/situacoes"),
            $requestDto
        );
    }

    public function alterarSituacaoMultiplosProdutos(array $ids, string $situacao): BlingResponse
    {
        $requestDto = AlteraSituacaoProdutoDto::factory([
            'idsProdutos' => $ids,
            'situacao' => $situacao
        ]);
        return $this->request(
            HttpMethods::POST,
            Uri::fromPath("/produtos/situacoes"),
            $requestDto
        );
    }
}
