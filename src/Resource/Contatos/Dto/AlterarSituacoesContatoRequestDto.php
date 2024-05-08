<?php

namespace PabloSanches\Bling\Resource\Contatos\Dto;

use PabloSanches\Bling\Resource\Dto\AbstractDto;

class AlterarSituacoesContatoRequestDto extends AbstractDto
{
    public array $idsContatos = [];
    public string $situacao;
}
