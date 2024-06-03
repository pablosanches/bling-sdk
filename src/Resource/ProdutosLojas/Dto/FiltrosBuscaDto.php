<?php

namespace PabloSanches\Bling\Resource\ProdutosLojas\Dto;

use PabloSanches\Bling\Resource\Dto\FiltersDto;

class FiltrosBuscaDto extends FiltersDto
{
    public ?int $idProduto = null;
    public ?int $idLoja = null;
    public ?int $idCategoriaProduto = null;
}
