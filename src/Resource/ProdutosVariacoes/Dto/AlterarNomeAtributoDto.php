<?php

namespace PabloSanches\Bling\Resource\ProdutosVariacoes\Dto;

use PabloSanches\Bling\Resource\Dto\AbstractDto;

class AlterarNomeAtributoDto extends AbstractDto
{
    public string $atributoAntigo;
    public string $atributoNovo;
}
