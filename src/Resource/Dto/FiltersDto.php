<?php

namespace PabloSanches\Bling\Resource\Dto;

class FiltersDto extends AbstractDto
{
    public ?int $pagina = 1;
    public ?int $limit = 100;
    public ?int $criterio = null;
    public ?string $dataInclusaoInicial = null;
    public ?string $dataInclusaoFinal = null;
    public ?string $dataAlteracaoInicial = null;
    public ?string $dataAlteracaoFinal = null;
}
