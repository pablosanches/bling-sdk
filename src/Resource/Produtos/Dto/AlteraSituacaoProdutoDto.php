<?php

namespace PabloSanches\Bling\Resource\Produtos\Dto;

use PabloSanches\Bling\Resource\Dto\AbstractDto;

class AlteraSituacaoProdutoDto extends AbstractDto
{
    public ?array $idsProdutos = null;
    public string $situacao;
}
