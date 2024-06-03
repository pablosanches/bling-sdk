<?php

namespace PabloSanches\Bling\Resource\ProdutosVariacoes;

use PabloSanches\Bling\Http\BlingResponse;
use PabloSanches\Bling\Http\HttpMethods;
use PabloSanches\Bling\Http\Uri;
use PabloSanches\Bling\Resource\AbstractResource;
use PabloSanches\Bling\Resource\ProdutosVariacoes\Dto\AlterarNomeAtributoDto;
use PabloSanches\Bling\Resource\ProdutosVariacoes\Dto\GerarCombinacoesDto;

class ProdutosVariacoes extends AbstractResource
{
    public function criar(array $payload): BlingResponse
    {
        throw new \DomainException('Operação indisponível para este resource.');
    }

    public function atualizar(int $id, array $payload): BlingResponse
    {
        throw new \DomainException('Operação indisponível para este resource.');
    }

    public function remover(int $id): BlingResponse
    {
        throw new \DomainException('Operação indisponível para este resource.');
    }

    public function buscar(int $idProdutoPai): BlingResponse
    {
        return $this->request(
            HttpMethods::GET,
            Uri::fromPath("/produtos/variacoes/{$idProdutoPai}")
        );
    }

    public function buscarTodos(array $options = []): BlingResponse
    {
        throw new \DomainException('Operação indisponível para este resource.');
    }

    public function alterarNomeAtributo(int $idProdutoPai, array $payload): BlingResponse
    {
        $requestDto = AlterarNomeAtributoDto::factory($payload);
        return $this->request(
            HttpMethods::PATCH,
            Uri::fromPath("/produtos/variacoes/{$idProdutoPai}/atributos"),
            $requestDto
        );
    }

    public function gerarCombinacoes(array $payload): BlingResponse
    {
        $requestDto = GerarCombinacoesDto::factory($payload);
        return $this->request(
            HttpMethods::POST,
            Uri::fromPath("produtos/variacoes/atributos/gerar-combinacoes"),
            $requestDto
        );
    }
}
