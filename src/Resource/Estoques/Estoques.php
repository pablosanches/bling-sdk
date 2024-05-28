<?php

namespace PabloSanches\Bling\Resource\Estoques;

use PabloSanches\Bling\Http\BlingResponse;
use PabloSanches\Bling\Http\HttpMethods;
use PabloSanches\Bling\Http\Uri;
use PabloSanches\Bling\Resource\AbstractResource;
use PabloSanches\Bling\Resource\Contatos\Dto\BuscarTodosContatosRequestDto;
use PabloSanches\Bling\Resource\Estoques\Dto\PersistirEstoqueRequestDto;

class Estoques extends AbstractResource
{
    public function criar(array $payload): BlingResponse
    {
        $requestDto = PersistirEstoqueRequestDto::factory($payload);
        return $this->request(
            HttpMethods::POST,
            Uri::fromPath('/estoques'),
            $requestDto
        );
    }

    public function atualizar(int $id, array $payload): BlingResponse
    {
        $requestDto = PersistirEstoqueRequestDto::factory($payload);
        return $this->request(
            HttpMethods::PUT,
            Uri::fromPath("/estoques/{$id}"),
            $requestDto
        );
    }

    public function remover(int $id): BlingResponse
    {
        throw new \DomainException('Operação indisponível para este resource.');
    }

    public function buscar(int $id): BlingResponse
    {
        return $this->request(
            HttpMethods::GET,
            Uri::fromPath("/estoques/saldos/{$id}")
        );
    }

    public function buscarTodos(array $options = []): BlingResponse
    {
        $queryDto = BuscarTodosContatosRequestDto::factory($options);
        return $this->request(
            HttpMethods::GET,
            Uri::fromPath('/estoques/saldos'),
            $queryDto
        );
    }
}
