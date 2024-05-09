<?php

namespace PabloSanches\Bling\Resource\Contatos\Dto;

use PabloSanches\Bling\Resource\Dto\FiltersDto;

class BuscarTodosContatosRequestDto extends FiltersDto
{
    public ?int $idTipoContato = null;
    public ?int $idVendedor = null;
    public ?string $uf = null;
    public ?string $telefone = null;
    public ?array $idsContatos = null;
    public ?string $numeroDocumento = null;
}
