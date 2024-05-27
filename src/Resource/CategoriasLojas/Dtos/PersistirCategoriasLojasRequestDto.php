<?php

namespace PabloSanches\Bling\Resource\CategoriasLojas\Dtos;

use PabloSanches\Bling\Resource\Dto\AbstractDto;

class PersistirCategoriasLojasRequestDto extends AbstractDto
{
    public array $loja;
    public ?string $descricao = null;
    public ?string $codigo = null;
    public ?array $categoriaProduto = [];
}
