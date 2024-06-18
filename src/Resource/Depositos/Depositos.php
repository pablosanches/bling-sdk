<?php

namespace PabloSanches\Bling\Resource\Depositos;

use PabloSanches\Bling\Http\BlingResponse;
use PabloSanches\Bling\Http\HttpMethods;
use PabloSanches\Bling\Http\Uri;
use PabloSanches\Bling\Resource\AbstractResource;
use PabloSanches\Bling\Resource\Depositos\Dto\PersistirDepositoRequestDto;

class Depositos extends AbstractResource
{
    public function criar(array $payload): BlingResponse
    {
        $requestDto = PersistirDepositoRequestDto::factory($payload);
        return $this->request(
            HttpMethods::POST,
            Uri::fromPath('/depositos'),
            $requestDto
        );
    }

    public function atualizar(int $id, array $payload): BlingResponse
    {
        $requestDto = PersistirDepositoRequestDto::factory($payload);
        return $this->request(
            HttpMethods::PUT,
            Uri::fromPath("/depositos/{$id}"),
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
            Uri::fromPath("/depositos/{$id}")
        );
    }

    public function buscarTodos(array $options = []): BlingResponse
    {
        return $this->request(
            HttpMethods::GET,
            Uri::fromPath('/depositos', $options)
        );
    }
}
