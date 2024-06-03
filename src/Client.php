<?php

namespace PabloSanches\Bling;

use PabloSanches\Bling\Http\HttpFactory;
use PabloSanches\Bling\Resource\CategoriasLojas\CategoriasLojas;
use PabloSanches\Bling\Resource\CategoriasProdutos\CategoriasProdutos;
use PabloSanches\Bling\Resource\Contatos\Contatos;
use PabloSanches\Bling\Resource\Depositos\Depositos;
use PabloSanches\Bling\Resource\Estoques\Estoques;
use PabloSanches\Bling\Resource\PedidosVendas\PedidosVendas;
use PabloSanches\Bling\Resource\Produtos\Produtos;
use PabloSanches\Bling\Resource\ProdutosLojas\ProdutosLojas;
use PabloSanches\Bling\Resource\ProdutosVariacoes\ProdutosVariacoes;
use GuzzleHttp\Client as HttpClient;

readonly class Client
{
    protected function __construct(
        protected readonly string $token,
        protected readonly array $params,
        protected HttpClient $httpClient
    ) {
    }

    public static function factory(
        string $token,
        array $params = [],
        ?HttpClient $httpClient = null
    ): self {
        if ($httpClient === null) {
            $httpClient = HttpFactory::factoryClient($token);
        }
        return new self($token, $params, $httpClient);
    }

    public function httpClient(): HttpClient
    {
        return $this->httpClient;
    }

    public function getMultilojas(): ?string
    {
        return $this->params['multilojas'] ?? null;
    }

    public function contatos(array $params = []): Contatos
    {
        return new Contatos($this, $params);
    }

    public function categoriasProdutos(array $params = []): CategoriasProdutos
    {
        return new CategoriasProdutos($this, $params);
    }

    public function categoriasLojas(array $params = []): CategoriasLojas
    {
        return new CategoriasLojas($this, $params);
    }

    public function depositos(array $params = []): Depositos
    {
        return new Depositos($this, $params);
    }

    public function estoques(array $params = []): Estoques
    {
        return new Estoques($this, $params);
    }

    public function produtos(array $params = []): Produtos
    {
        return new Produtos($this, $params);
    }

    public function produtosLojas(array $params = []): ProdutosLojas
    {
        return new ProdutosLojas($this, $params);
    }

    public function produtosVariacoes(array $params = []): ProdutosVariacoes
    {
        return new ProdutosVariacoes($this, $params);
    }

    public function pedidosVendas(array $params = []): PedidosVendas
    {
        return new PedidosVendas($this, $params);
    }
}
