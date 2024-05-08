<?php

namespace PabloSanches\Bling\Resource\Contatos\Dto;

use PabloSanches\Bling\Resource\Dto\AbstractDto;

class BuscarTodosContatosRequestDto extends AbstractDto
{
    public ?int $pagina = null;
    public ?int $limit = null;
    public ?string $pesquisar = null;
    public ?int $criterio = null;
    public ?string $dataInclusaoInicial = null;
    public ?string $dataInclusaoFinal = null;
    public ?string $dataAlteracaoInicial = null;
    public ?string $dataAlteracaoFinal = null;
    public ?int $idTipoContato = null;
    public ?int $idVendedor = null;
    public ?string $uf = null;
    public ?string $telefone = null;
    public ?array $idsContatos = null;
    public ?string $numeroDocumento = null;
}
