<?php

namespace PabloSanches\Bling\Http\Dto;

use PabloSanches\Bling\Resource\Dto\AbstractDto;

class ErrorResponseDto extends AbstractDto
{
    public ?array $error = [];
}
