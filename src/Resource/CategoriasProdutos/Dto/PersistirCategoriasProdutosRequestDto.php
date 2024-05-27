<?php

namespace PabloSanches\Bling\Resource\CategoriasProdutos\Dto;

use PabloSanches\Bling\Resource\Dto\AbstractDto;

class PersistirCategoriasProdutosRequestDto extends AbstractDto
{
    public string $descricao;
    public ?array $categoriaPai = [];
}
