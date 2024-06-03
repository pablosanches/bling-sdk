<?php

namespace PabloSanches\Bling\Resource\PedidosVendas\Dto;

use PabloSanches\Bling\Resource\Dto\FiltersDto;

class BuscarTodosPedidosFiltrosDto extends FiltersDto
{
    public ?int $idContato = null;
    public ?array $idsSituacoes = [];
    public ?int $numero = null;
    public ?int $idLoja = null;
    public ?int $idVendedor = null;
    public ?int $idControleCaixa = null;
    public ?int $numerosLojas = null;
}
