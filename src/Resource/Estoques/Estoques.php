<?php

namespace PabloSanches\Bling\Resource\Estoques;

use PabloSanches\Bling\Http\BlingResponse;
use PabloSanches\Bling\Http\HttpMethods;
use PabloSanches\Bling\Http\Uri;
use PabloSanches\Bling\Resource\AbstractResource;
use PabloSanches\Bling\Resource\Estoques\Dto\AtualizarEstoqueRequestDto;
use PabloSanches\Bling\Resource\Estoques\Dto\BuscarSaldoDepositoRequestDto;
use PabloSanches\Bling\Resource\Estoques\Dto\BuscarSaldosRequestDto;
use PabloSanches\Bling\Resource\Estoques\Dto\CriarEstoqueRequestDto;

class Estoques extends AbstractResource
{
    public function criar(array $payload): BlingResponse
    {
        $requestDto = CriarEstoqueRequestDto::factory($payload);
        return $this->request(
            HttpMethods::POST,
            Uri::fromPath('/estoques'),
            $requestDto
        );
    }

    public function atualizar(int $id, array $payload): BlingResponse
    {
        $requestDto = AtualizarEstoqueRequestDto::factory($payload);
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
        throw new \DomainException('Operação indisponível para este resource.');
    }

    public function buscarPorDeposito(array $options): BlingResponse
    {
        $queryDto = BuscarSaldoDepositoRequestDto::factory($options);
        return $this->request(
            HttpMethods::GET,
            Uri::fromPath(
                "/estoques/saldos/{$queryDto->idDeposito}",
                [
                    'idDeposito' => $queryDto->idDeposito,
                    'idsProdutos' => $queryDto->idsProdutos
                ]
            ),
            $queryDto
        );
    }

    public function buscarTodos(array $options = []): BlingResponse
    {
        $queryDto = BuscarSaldosRequestDto::factory($options);
        return $this->request(
            HttpMethods::GET,
            Uri::fromPath('/estoques/saldos', ['idsProdutos' => $queryDto->idsProdutos]),
            $queryDto
        );
    }
}
