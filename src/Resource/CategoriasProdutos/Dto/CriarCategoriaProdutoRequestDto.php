<?php

namespace PabloSanches\Bling\Resource\CategoriasProdutos\Dto;

use PabloSanches\Bling\Resource\Dto\AbstractDto;

class CriarCategoriaProdutoRequestDto extends AbstractDto
{
    public string $descricao;
    public array $categoriaPai = [];
}
