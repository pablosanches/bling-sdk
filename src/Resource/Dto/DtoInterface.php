<?php

namespace PabloSanches\Bling\Resource\Dto;

interface DtoInterface
{
    public static function factory(array $params = []): DtoInterface;
    public function export(): array;
}
