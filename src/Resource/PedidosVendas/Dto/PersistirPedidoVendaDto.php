<?php

namespace PabloSanches\Bling\Resource\PedidosVendas\Dto;

use PabloSanches\Bling\Resource\Dto\AbstractDto;

class PersistirPedidoVendaDto extends AbstractDto
{
    public ?int $numero = null;
    public ?string $numeroLoja = null;
    public string $data;
    public ?string $dataSaida = null;
    public ?string $dataPrevista = null;
    public array $contato;
    public ?array $loja = null;
    public ?string $numeroPedidoCompras = null;
    public ?string $outrasDespesas = null;
    public ?string $observacoes = null;
    public ?string $observacoesInternas = null;
    public ?array $desconto = null;
    public ?array $categoria = null;
    public ?array $tributacao = null;
    public array $itens;
    public ?array $parcelas = [;
    public ?array $transporte = [];
    public ?array $vendedor = [];
    public ?array $intermediador = [];
    public ?array $taxas = [];
}
