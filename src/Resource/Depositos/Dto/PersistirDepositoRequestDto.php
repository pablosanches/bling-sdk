<?php

namespace PabloSanches\Bling\Resource\Depositos\Dto;

use PabloSanches\Bling\Resource\Dto\AbstractDto;

class PersistirDepositoRequestDto extends AbstractDto
{
    public string $descricao;
    public int $situacao;
    public bool $padrao;
    public bool $desconsiderarSaldo;
}
