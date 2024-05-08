<?php

namespace PabloSanches\Bling\Resource\Contatos\Dto;

use PabloSanches\Bling\Resource\Dto\AbstractDto;

class PersistirContatoRequestDto extends AbstractDto
{
    public ?string $nome = null;
    public ?string $codigo = null;
    public ?string $situacao = null;
    public ?string $numeroDocumento = null;
    public ?string $telefone = null;
    public ?string $celular = null;
    public ?string $fantasia = null;
    public ?string $tipo = null;
    public ?string $indicadorIe = null;
    public ?string $ie = null;
    public ?string $rg = null;
    public ?string $orgaoEmissor = null;
    public ?string $email = null;
    public ?array $endereco = [];
    public ?array $vendedor = [];
    public ?array $dadosAdicionais = [];
    public ?array $financeiro = [];
    public ?array $pais = [];
    public ?array $tiposContato = [];
    public ?array $pessoasContato = [];
}
