<?php

namespace PabloSanches\Bling\Resource\Estoques\Dto;

use PabloSanches\Bling\Resource\Dto\FiltersDto;

class BuscarSaldosRequestDto extends FiltersDto
{
    public array $idsProdutos = [];

    public ?string $codigo = null;
}
