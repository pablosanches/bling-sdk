<?php

namespace PabloSanches\Bling\Resource\ProdutosLojas\Dto;

use PabloSanches\Bling\Resource\Dto\AbstractDto;

class PersistirProdutoLojasRequestDto extends AbstractDto
{
    public string $codigo;
    public ?float $preco = null;
    public ?float $precoPromocional = null;
    public array $produto = [];
    public array $loja = [];
    public array $fornecedorLoja = [];
    public array $marcaLoja = [];
    public array $categoriasProdutos = [];
}
