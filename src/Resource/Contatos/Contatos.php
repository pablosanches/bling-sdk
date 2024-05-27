<?php

namespace PabloSanches\Bling\Resource\Contatos;

use PabloSanches\Bling\Http\BlingResponse;
use PabloSanches\Bling\Http\HttpMethods;
use PabloSanches\Bling\Http\Uri;
use PabloSanches\Bling\Resource\AbstractResource;
use PabloSanches\Bling\Resource\Contatos\Dto\AlterarSituacoesContatoRequestDto;
use PabloSanches\Bling\Resource\Contatos\Dto\AlteraSituacaoRequestDto;
use PabloSanches\Bling\Resource\Contatos\Dto\BuscarTodosContatosRequestDto;
use PabloSanches\Bling\Resource\Contatos\Dto\PersistirContatoRequestDto;

class Contatos extends AbstractResource
{
    public function criar(array $payload): BlingResponse
    {
        $requestDto = PersistirContatoRequestDto::factory($payload);
        return $this->request(
            HttpMethods::POST,
            Uri::fromPath('/contatos'),
            $requestDto
        );
    }

    public function atualizar(int $id, array $payload): BlingResponse
    {
        $requestDto = PersistirContatoRequestDto::factory($payload);
        return $this->request(
            HttpMethods::PUT,
            Uri::fromPath("/contatos/{$id}"),
            $requestDto
        );
    }

    public function remover(int $id): BlingResponse
    {
        return $this->request(
            HttpMethods::DELETE,
            Uri::fromPath("/contatos/{$id}")
        );
    }

    public function buscar(int $id): BlingResponse
    {
        return $this->request(
            HttpMethods::GET,
            Uri::fromPath("/contatos/{$id}")
        );
    }

    public function buscarTodos(array $options = []): BlingResponse
    {
        $queryDto = BuscarTodosContatosRequestDto::factory($options);
        return $this->request(
            HttpMethods::GET,
            Uri::fromPath('/contatos'),
            $queryDto
        );
    }

    public function removerMultiplos(array $ids): BlingResponse
    {
        return $this->request(
            HttpMethods::DELETE,
            Uri::fromPath("/contatos", ['idsContatos' => $ids])
        );
    }

    public function buscarTipos(int $id): BlingResponse
    {
        return $this->request(
            HttpMethods::GET,
            Uri::fromPath("/contatos/{$id}/tipos")
        );
    }

    public function buscarConsumidoresFinais(): BlingResponse
    {
        return $this->request(
            HttpMethods::GET,
            Uri::fromPath("/contatos/consumidor-final")
        );
    }

    public function atualizarSituacao(int $id, string $situacao): BlingResponse
    {
        $requestDto = AlteraSituacaoRequestDto::factory(['situacao' => $situacao]);
        return $this->request(
            HttpMethods::PATCH,
            Uri::fromPath("/contatos/{$id}/situacoes"),
            $requestDto
        );
    }

    public function alterarSituacoesMultiplos(array $ids, string $situacao): BlingResponse
    {
        $requestDto = AlterarSituacoesContatoRequestDto::factory([
            'idsContatos' => $ids,
            'situacao' => $situacao
        ]);
        return $this->request(
            HttpMethods::POST,
            Uri::fromPath('/contatos/situacoes'),
            $requestDto
        );
    }
}
