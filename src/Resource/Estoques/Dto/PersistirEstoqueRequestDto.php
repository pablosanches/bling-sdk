<?php

namespace PabloSanches\Bling\Resource\Estoques\Dto;

use PabloSanches\Bling\Resource\Dto\AbstractDto;

class PersistirEstoqueRequestDto extends AbstractDto
{
    public array $produto;
    public ?array $deposito = [];
    public string $operacao;
    public ?float $preco = null;
    public ?float $custo = null;
    public int $quantidade;
    public ?int $observacoes = null;
}
