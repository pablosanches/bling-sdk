<?php

namespace PabloSanches\Bling\Resource\Produtos\Dto;

use PabloSanches\Bling\Resource\Dto\FiltersDto;

class FiltrosBuscaProdutosDto extends FiltersDto
{
    public ?string $tipo = null;
    public ?int $idComponente = null;
    public ?int $idCategoria = null;
    public ?int $idLoja = null;
    public ?int $codigo = null;
    public ?int $nome = null;
    public ?array $idsProdutos = null;
}
