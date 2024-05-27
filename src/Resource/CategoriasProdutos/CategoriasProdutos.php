<?php

namespace PabloSanches\Bling\Resource\CategoriasProdutos;

use PabloSanches\Bling\Http\BlingResponse;
use PabloSanches\Bling\Http\HttpMethods;
use PabloSanches\Bling\Http\Uri;
use PabloSanches\Bling\Resource\AbstractResource;
use PabloSanches\Bling\Resource\CategoriasProdutos\Dto\PersistirCategoriasProdutosRequestDto;
use PabloSanches\Bling\Resource\Dto\FiltersDto;

class CategoriasProdutos extends AbstractResource
{
    public function criar(array $payload): BlingResponse
    {
        $requestDto = PersistirCategoriasProdutosRequestDto::factory($payload);
        return $this->request(
            HttpMethods::POST,
            Uri::fromPath('/categorias/produtos'),
            $requestDto
        );
    }

    public function atualizar(int $id, array $payload): BlingResponse
    {
        $requestDto = PersistirCategoriasProdutosRequestDto::factory($payload);
        return $this->request(
            HttpMethods::PUT,
            Uri::fromPath("/categorias/produtos/{$id}"),
            $requestDto
        );
    }

    public function remover(int $id): BlingResponse
    {
        return $this->request(
            HttpMethods::DELETE,
            Uri::fromPath("/categorias/produtos/{$id}")
        );
    }

    public function buscar(int $id): BlingResponse
    {
        return $this->request(
            HttpMethods::GET,
            Uri::fromPath("/categorias/produtos/{$id}")
        );
    }

    public function buscarTodos(array $options = []): BlingResponse
    {
        $queryDto = FiltersDto::factory($options);
        return $this->request(
            HttpMethods::GET,
            Uri::fromPath('/categorias/produtos'),
            $queryDto
        );
    }
}
