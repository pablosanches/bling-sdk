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
use PabloSanches\Bling\Resource\Contatos\Dto\RemoverMultiplosContatosRequestDto;

class Contatos extends AbstractResource
{
    public function removerMultiplos(array $idsContatos): BlingResponse
    {
        return $this->request(
            HttpMethods::DELETE,
            Uri::fromPath("/contatos", ['idsContatos' => $idsContatos])
        );
    }

    public function remover(int $idContato): BlingResponse
    {
        return $this->request(
            HttpMethods::DELETE,
            Uri::fromPath("/contatos/{$idContato}")
        );
    }

    public function todos(array $params = []): BlingResponse
    {
        $queryDto = BuscarTodosContatosRequestDto::factory($params);
        return $this->request(
            HttpMethods::GET,
            Uri::fromPath('/contatos'),
            $queryDto
        );
    }

    public function buscar(int $idContato): BlingResponse
    {
        return $this->request(
            HttpMethods::GET,
            Uri::fromPath("/contatos/{$idContato}")
        );
    }

    public function buscarTipos(int $idContato): BlingResponse
    {
        return $this->request(
            HttpMethods::GET,
            Uri::fromPath("/contatos/{$idContato}/tipos")
        );
    }

    public function buscarConsumidoresFinais(): BlingResponse
    {
        return $this->request(
            HttpMethods::GET,
            Uri::fromPath("/contatos/consumidor-final")
        );
    }

    public function atualizarSituacao(int $idContato, string $situacao): BlingResponse
    {
        $requestDto = AlteraSituacaoRequestDto::factory(['situacao' => $situacao]);
        return $this->request(
            HttpMethods::PATCH,
            Uri::fromPath("/contatos/{$idContato}/situacoes"),
            $requestDto
        );
    }

    public function criar(array $params): BlingResponse
    {
        $requestDto = PersistirContatoRequestDto::factory($params);
        return $this->request(
            HttpMethods::POST,
            Uri::fromPath('/contatos'),
            $requestDto
        );
    }

    public function alterarSituacoesMultiplos(array $idsContatos, string $situacao): BlingResponse
    {
        $requestDto = AlterarSituacoesContatoRequestDto::factory([
            'idsContatos' => $idsContatos,
            'situacao' => $situacao
        ]);
        return $this->request(
            HttpMethods::POST,
            Uri::fromPath('/contatos/situacoes'),
            $requestDto
        );
    }

    public function alterar(int $idContato, array $params): BlingResponse
    {
        $requestDto = PersistirContatoRequestDto::factory($params);
        return $this->request(
            HttpMethods::PUT,
            Uri::fromPath("/contatos/{$idContato}"),
            $requestDto
        );
    }
}
