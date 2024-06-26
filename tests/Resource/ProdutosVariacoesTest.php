<?php

namespace PabloSanches\Bling\Resource;

use PabloSanches\Bling\BaseTesting;
use PHPUnit\Framework\Attributes\TestDox;

class ProdutosVariacoesTest extends BaseTesting
{
    #[TestDox('Obter produtos e variações')]
    public function testFetchProductsAndVariations(): void
    {
        $mockData = $this->getMockFile('produtos_variacoes/buscar.json');
        $blingClient = $this->getBlingClient($mockData);
        $idProdutoPai = 16257679308;
        $response = $blingClient->produtosVariacoes()->buscar($idProdutoPai);
        self::assertEquals(200, $response->getStatusCode());
    }

    #[TestDox('Alterar o nome do atributo nas variações')]
    public function testChangeAttributesNames(): void
    {
        $mockData = $this->getMockFile('produtos_variacoes/alterar-nome-atributos.json');
        $blingClient = $this->getBlingClient($mockData);
        $idProdutoPai = 16257679308;
        $response = $blingClient->produtosVariacoes()->alterarNomeAtributo($idProdutoPai, $mockData['request']);
        self::assertEquals(200, $response->getStatusCode());
    }

    #[TestDox('Gerar combinações')]
    public function testGenerateCombinations(): void
    {
        $mockData = $this->getMockFile('produtos_variacoes/gerar-combinacoes.json');
        $blingClient = $this->getBlingClient($mockData);
        $response = $blingClient->produtosVariacoes()->gerarCombinacoes($mockData['request']);
        self::assertEquals(200, $response->getStatusCode());
    }
}
