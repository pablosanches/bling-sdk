<?php

namespace PabloSanches\Bling\Resource\Estoques\Dto;

use PabloSanches\Bling\Resource\Dto\AbstractDto;

class CriarEstoqueRequestDto extends AbstractDto
{
    public array $produto;
    public array $deposito;
    public string $operacao;
    public ?float $preco = null;
    public ?float $custo = null;
    public float $quantidade;
    public ?string $observacoes = null;
}
