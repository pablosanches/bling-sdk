<?php

namespace PabloSanches\Bling\Resource\CategoriasLojas;

use PabloSanches\Bling\Client as BlingClient;
use PabloSanches\Bling\Http\BlingResponse;
use PabloSanches\Bling\Http\HttpMethods;
use PabloSanches\Bling\Http\Uri;
use PabloSanches\Bling\Resource\AbstractResource;
use PabloSanches\Bling\Resource\CategoriasLojas\Dtos\PersistirCategoriasLojasRequestDto;
use PabloSanches\Bling\Resource\Dto\FiltersDto;

class CategoriasLojas extends AbstractResource
{
    public function __construct(BlingClient $blingClient, array $params = [])
    {
        parent::__construct($blingClient, $params);
        if (!$this->hasMultilojas()) {
            throw new \DomainException('Não é possível utilizar o recurso de multilojas sem o ID da integração');
        }
    }

    public function criar(array $payload): BlingResponse
    {
        $payload = $this->attachMultilojasPayload($payload);
        $requestDto = PersistirCategoriasLojasRequestDto::factory($payload);
        return $this->request(
            HttpMethods::POST,
            Uri::fromPath('/categorias/lojas'),
            $requestDto
        );
    }

    public function atualizar(int $id, array $payload): BlingResponse
    {
        $payload = $this->attachMultilojasPayload($payload);
        $requestDto = PersistirCategoriasLojasRequestDto::factory($payload);
        return $this->request(
            HttpMethods::PUT,
            Uri::fromPath("/categorias/lojas/{$id}"),
            $requestDto
        );
    }

    public function remover(int $id): BlingResponse
    {
        return $this->request(
            HttpMethods::DELETE,
            Uri::fromPath("/categorias/lojas/{$id}")
        );
    }

    public function buscar(int $id): BlingResponse
    {
        return $this->request(
            HttpMethods::GET,
            Uri::fromPath("/categorias/lojas/{$id}")
        );
    }

    public function buscarTodos(array $options = []): BlingResponse
    {
        $queryDto = FiltersDto::factory($options);
        return $this->request(
            HttpMethods::GET,
            Uri::fromPath('/categorias/lojas'),
            $queryDto
        );
    }
}
