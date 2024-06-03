<?php

namespace PabloSanches\Bling\Resource\Produtos\Dto;

use PabloSanches\Bling\Resource\Dto\AbstractDto;

class PersistirProdutoRequestDto extends AbstractDto
{
    public ?int $id = null;
    public string $nome;
    public ?string $codigo = null;
    public ?float $preco = null;
    public string $tipo;
    public string $situacao;
    public string $formato;
    public ?string $descricaoCurta = null;
    public ?string $dataValidade = null;
    public ?string $unidade = null;
    public ?float $pesoLiquido = null;
    public ?float $pesoBruto = null;
    public ?int $volumes = null;
    public ?float $itensPorCaixa = null;
    public ?string $gtin = null;
    public ?string $gtinEmbalagem = null;
    public ?string $tipoProducao = null;
    public ?int $condicao = null;
    public ?bool $freteGratis = null;
    public ?string $marca = null;
    public ?string $descricaoComplementar = null;
    public ?string $linkExterno = null;
    public ?string $observacoes = null;
    public ?string $descricaoEmbalagemDiscreta = null;
    public ?array $categoria = [];
    public ?array $estoque = [];
    public ?string $actionEstoque = null;
    public ?array $dimensoes = [];
    public ?array $tributacao = [];
    public ?array $midia = [];
    public ?array $linhaProduto = [];
    public ?array $estrutura = [];
    public ?array $camposCustomizados = [];
    public ?array $variacoes = [];
}
