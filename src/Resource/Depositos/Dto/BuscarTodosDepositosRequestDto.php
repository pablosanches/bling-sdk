<?php

namespace PabloSanches\Bling\Resource\Depositos\Dto;

use PabloSanches\Bling\Resource\Dto\FiltersDto;

class BuscarTodosDepositosRequestDto extends FiltersDto
{
    public ?string $descricao = null;

    public ?int $situacao = null;
}
