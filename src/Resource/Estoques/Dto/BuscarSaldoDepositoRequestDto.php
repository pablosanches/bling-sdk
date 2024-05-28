<?php

namespace PabloSanches\Bling\Resource\Estoques\Dto;

use PabloSanches\Bling\Resource\Dto\FiltersDto;

class BuscarSaldoDepositoRequestDto extends FiltersDto
{
    public int $idDeposito;
    public array $idsProdutos;
    public ?string $codigo = null;
}
