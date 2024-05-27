<?php

namespace PabloSanches\Bling\Resource;

use PabloSanches\Bling\Http\BlingResponse;

interface ResourceInterface
{
    public function criar(array $payload): BlingResponse;
    public function atualizar(int $id, array $payload): BlingResponse;
    public function remover(int $id): BlingResponse;
    public function buscar(int $id): BlingResponse;
    public function buscarTodos(array $options = []): BlingResponse;
}
