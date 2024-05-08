<?php

namespace PabloSanches\Bling\Resource\Contatos;

use PabloSanches\Bling\Http\HttpMethods;
use PabloSanches\Bling\Resource\AbstractResource;
use PabloSanches\Bling\Resource\Contatos\Dto\AlterarSituacoesContatoRequestDto;
use PabloSanches\Bling\Resource\Contatos\Dto\AlteraSituacaoRequestDto;
use PabloSanches\Bling\Resource\Contatos\Dto\BuscarTodosContatosRequestDto;
use PabloSanches\Bling\Resource\Contatos\Dto\PersistirContatoRequestDto;
use PabloSanches\Bling\Resource\Contatos\Dto\RemoverMultiplosContatosRequestDto;
use PabloSanches\Bling\Resource\Dto\DtoInterface;

class Contatos extends AbstractResource
{
//    public function removerMultiplos(array $idsContatos): DtoInterface
//    {
//        $requestDto = RemoverMultiplosContatosRequestDto::factory(['idsContatos' => $idsContatos]);
//    }
//
//    public function remover(): DtoInterface
//    {
//    }
//
//    public function buscarTodos(array $params = []): DtoInterface
//    {
//        $requestDto = BuscarTodosContatosRequestDto::factory($params);
//    }
//
//    public function buscar(): DtoInterface
//    {
//    }
//
//    public function buscarTipos(): DtoInterface
//    {
//    }
//
//    public function buscarConsumidorFinal(): DtoInterface
//    {
//    }
//
//    public function atualizarSituacao(string $situacao): DtoInterface
//    {
//        $requestDto = AlteraSituacaoRequestDto::factory(['situacao' => $situacao]);
//    }
//
    public function criar(array $params): DtoInterface
    {
        $requestDto = PersistirContatoRequestDto::factory($params);
        $response = $this->request(HttpMethods::POST, '/contatos', $requestDto);
        exit(var_dump($response));
    }
//
//    public function alterarSituacoesMultiplos(array $idsContatos, string $situacao): DtoInterface
//    {
//        $requestDto = AlterarSituacoesContatoRequestDto::factory([
//            'idsContatos' => $idsContatos,
//            'situacao' => $situacao
//        ]);
//    }
//
//    public function alterar(array $params): DtoInterface
//    {
//        $requestDto = PersistirContatoRequestDto::factory($params);
//    }
}
