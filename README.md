# Bling! - API v3 - !! EM DESENVOLVIMENTO !!
<img src="https://developer.bling.com.br/build/assets/developer-0085d380.svg" alt="Bling!" width="400" style="text-align: center;"/>

![Workflow](https://github.com/pablosanches/bling-sdk/actions/workflows/master.yml/badge.svg)

Esta é uma SDK **não** oficial que facilita a integração com o [Bling!](https://developer.bling.com.br/bling-api#introdu%C3%A7%C3%A3o) utilizando a API V3.

Pule para:
* [Introdução](#Introdução)
* [Contatos](#Contatos)
  * [Criando um contato](#Criando-um-contato)
  * [Atualizando um contato](#Atualizando-um-contato)
  * [Buscando todos os contatos](#Buscando-todos-os-contatos)
  * [Buscando contato por ID](#Buscando-contato-por-ID)
  * [Buscando tipos de um contato](#Buscando-tipos-de-um-contato)
  * [Buscando contatos consumidores finais](#Buscando-contatos-consumidores-finais)
  * [Atualizando a situação de um contato](#Atualizando-a-situação-de-um-contato)
  * [Atualizando a situação de múltiplos contatos](#Atualizando-a-situação-de-múltiplos-contatos)
  * [Remover um contato pelo seu ID](#Remover-um-contato-pelo-seu-ID)
  * [Remover múltiplos contatos](#Remover-múltiplos-contatos)
* [Categorias de Produtos](#Categorias-de-Produtos)
  * [Criando uma categoria de produto](#Criando-uma-categoria-de-produto)
  * [Atualizando uma categoria de produtos](#Atualizando-uma-categoria-de-produtos)
  * [Buscando uma categoria de produtos pelo seu ID](#Buscando-uma-categoria-de-produtos-pelo-seu-ID)
  * [Buscando todos as categorias de produtos](#Buscando-todos-as-categorias-de-produtos)
  * [Removendo uma categoria de produto](#Removendo-uma-categoria-de-produto8)
* [Categorias Lojas (Multilojas)](#Categorias-lojas)
  * [Criando um vínculo de uma categoria de produto](#Criando-um-vínculo-de-uma-categoria-de-produto)
  * [Atualizando um vínculo de uma categoria de produto](#Atualizando-um-vínculo-de-uma-categoria-de-produto)
  * [Buscando um vínculo de categoria de produto pelo seu ID](#Buscando-um-vínculo-de-categoria-de-produto-pelo-seu-ID)
  * [Buscando todos os vínculos de categorias de produtos](#Buscando-todos-os-vínculos-de-categorias-de-produtos)
  * [Removendo um vínculo de uma categoria de produto](#Removendo-um-vínculo-de-uma-categoria-de-produto)

## Introdução
A API V3 do [Bling!](https://developer.bling.com.br/bling-api#introdu%C3%A7%C3%A3o) utiliza do modelo de autenticação OAuth 2.0, sendo assim, antes de qualquer coisa você precisará registrar um aplicativo em sua conta do Bling! para conseguir realizar todas as etapas de autenticação, você pode saber mais [aqui!](https://developer.bling.com.br/aplicativos#introdu%C3%A7%C3%A3o)

Esta SDK segue um padrão de roteamento dinâmico baseado nos módulos implementados, desta forma, você precisará construir a instância de client da SDK e chamar seus módulos através deste client. 

Exemplo:
```php
    use PabloSanches\Bling\Client;
    
    try {
        $blingClient = Client::factory('<seu-token-aqui>');
        $payload = [
            'nome' => 'Pablo Sanches'
        ];
        $response = $bling->contatos()->criar($payload);
    } catch (\Exception $e) {
        // $e->getMessage();
    }
```

### Os modelos de resposta dos resources trazem alguns métodos que facilitam a integração:
```php
use PabloSanches\Bling\Client;
    
    try {
        $blingClient = Client::factory('<seu-token-aqui>');
        $payload = [
            'nome' => 'Pablo Sanches'
        ];
        $response = $bling->contatos()->criar($payload);
        
        // Este método faz um unwrap do elemento data que o bling coloca por padrão em seu objeto de resposta
        var_dump($response->getData());
        
        // Este método traz a reposta padrão do Bling
        var_dump($response->getContents());
        
        // Este método traz o statusCode da requisição
        var_dump($response->getStatusCode());
        
        // Este método indica se houve algum erro na requisição
        var_dump($response->isError());
        
        // Este método faz um unwrap do elemento error que o bling coloca por padrão em seu objeto de resposta de erros
        var_dump($response->getError());
    } catch (\Exception $e) {
        // $e->getMessage();
    }
```

### Em alguns casos o bling pode paginar e oferecer filtros para as requests
```php
use PabloSanches\Bling\Client;
    
    try {
        $blingClient = Client::factory('<seu-token-aqui>');
        
        $filtros = [
            'pagina' => 1,
            'limite' => 100,
            'criterio' => 1,
            'dataInclusaoInicial' => '2024-01-01'
        ];
        
        $response = $bling->contatos()->buscarTodos($filtros);
    } catch (\Exception $e) {
        // $e->getMessage();
    }
```

## Contatos
[Ver documentação](https://developer.bling.com.br/referencia#/Contatos)

### Criando um contato
[Ver documentação](https://developer.bling.com.br/referencia#/Contatos/post_contatos)
```php
    use PabloSanches\Bling\Client;
    
    try {
        $blingClient = Client::factory('<seu-token-aqui>');
        $payload = [
            'nome' => 'Pablo Sanches'
        ];
        $response = $bling->contatos()->criar($payload);
    } catch (\Exception $e) {
        // $e->getMessage();
    }
```

### Atualizando um contato:
[Ver documentação](https://developer.bling.com.br/referencia#/Contatos/put_contatos__idContato_)
```php
    use PabloSanches\Bling\Client;
    
    try {
        $blingClient = Client::factory('<seu-token-aqui>');
        $payload = [
            'nome' => 'Pablo Sanches'
        ];
        $response = $bling->contatos()->atualizar($id, $payload);
    } catch (\Exception $e) {
        // $e->getMessage();
    }
```

### Buscando todos os contatos:
[Ver documentação](https://developer.bling.com.br/referencia#/Contatos/get_contatos)
```php
use PabloSanches\Bling\Client;
    
    try {
        $blingClient = Client::factory('<seu-token-aqui>');
        
        $filtros = [
            'pagina' => 1,
            'limite' => 100,
            'criterio' => 1,
            'dataInclusaoInicial' => '2024-01-01'
        ];
        
        $response = $bling->contatos()->buscarTodos($filtros);
    } catch (\Exception $e) {
        // $e->getMessage();
    }
```

### Buscando contato por ID:
[Ver documentação](https://developer.bling.com.br/referencia#/Contatos/get_contatos__idContato_)
```php
use PabloSanches\Bling\Client;
    
    try {
        $blingClient = Client::factory('<seu-token-aqui>');
        $idContato = 1; 
        $response = $bling->contatos()->buscar($idContato);
    } catch (\Exception $e) {
        // $e->getMessage();
    }
```

### Buscando tipos de um contato:
[Ver documentação](https://developer.bling.com.br/referencia#/Contatos/get_contatos__idContato__tipos)
```php
use PabloSanches\Bling\Client;
    
    try {
        $blingClient = Client::factory('<seu-token-aqui>');
        $idContato = 1; 
        $response = $bling->contatos()->buscarTipos($idContato);
    } catch (\Exception $e) {
        // $e->getMessage();
    }
```

### Buscando contatos consumidores finais:
[Ver documentação](https://developer.bling.com.br/referencia#/Contatos/get_contatos_consumidor_final)
```php
use PabloSanches\Bling\Client;
    
    try {
        $blingClient = Client::factory('<seu-token-aqui>');
        $idContato = 1; 
        $response = $bling->contatos()->buscarConsumidoresFinais($idContato);
    } catch (\Exception $e) {
        // $e->getMessage();
    }
```

### Atualizando a situação de um contato:
[Ver documentação](https://developer.bling.com.br/referencia#/Contatos/patch_contatos__idContato__situacoes)
```php
use PabloSanches\Bling\Client;
    
    try {
        $blingClient = Client::factory('<seu-token-aqui>');
        $idContato = 1; 
        $situacao = 'A';
        $response = $bling->contatos()->atualizarSituacao($idContato, $situacao);
    } catch (\Exception $e) {
        // $e->getMessage();
    }
```

### Atualizando a situação de múltiplos contatos:
[Ver documentação](https://developer.bling.com.br/referencia#/Contatos/post_contatos_situacoes)
```php
use PabloSanches\Bling\Client;
    
    try {
        $blingClient = Client::factory('<seu-token-aqui>');
        $idsContatos = [1, 2, 3, 4]; 
        $situacao = 'A';
        $response = $bling->contatos()->alterarSituacoesMultiplos($idsContatos, $situacao);
    } catch (\Exception $e) {
        // $e->getMessage();
    }
```

### Remover um contato pelo seu ID:
[Ver documentação](https://developer.bling.com.br/referencia#/Contatos/delete_contatos__idContato_)
```php
use PabloSanches\Bling\Client;
    
    try {
        $blingClient = Client::factory('<seu-token-aqui>');
        $idContato = 1;
        $response = $bling->contatos()->remover($idContato);
    } catch (\Exception $e) {
        // $e->getMessage();
    }
```

### Remover múltiplos contatos:
[Ver documentação](https://developer.bling.com.br/referencia#/Contatos/delete_contatos)
```php
use PabloSanches\Bling\Client;
    
    try {
        $blingClient = Client::factory('<seu-token-aqui>');
        $idsContatos = [1, 2, 3, 4];
        $response = $bling->contatos()->removerMultiplos($idContato);
    } catch (\Exception $e) {
        // $e->getMessage();
    }
```

## Categorias de Produtos
[Ver documentação](https://developer.bling.com.br/referencia#/Categorias%20-%20Produtos)

### Criando uma categoria de produto:
[Ver documentação](https://developer.bling.com.br/referencia#/Categorias%20-%20Produtos/post_categorias_produtos)
```php
    use PabloSanches\Bling\Client;
    
    try {
        $blingClient = Client::factory('<seu-token-aqui>');
        $payload = [
            'descricao' => 'Eletrônicos'
        ];
        $response = $bling->categoriasProdutos()->criar($payload);
    } catch (\Exception $e) {
        // $e->getMessage();
    }
    
```

### Atualizando uma categoria de produtos:
[Ver documentação](https://developer.bling.com.br/referencia#/Categorias%20-%20Produtos/put_categorias_produtos__idCategoriaProduto_)
```php
    use PabloSanches\Bling\Client;
    
    try {
        $blingClient = Client::factory('<seu-token-aqui>');
        $payload = [
            'descricao' => 'Eletrônicos - Atualizado'
        ];
        $idCategoria = 123456789;
        $response = $bling->categoriasProdutos()->atualizar($idCategoria, $payload);
    } catch (\Exception $e) {
        // $e->getMessage();
    }
    
```

### Buscando uma categoria de produtos pelo seu ID:
[Ver documentação](https://developer.bling.com.br/referencia#/Categorias%20-%20Produtos/get_categorias_produtos__idCategoriaProduto_)
```php
    use PabloSanches\Bling\Client;
    
    try {
        $blingClient = Client::factory('<seu-token-aqui>');
        $idCategoria = 123456789;
        $response = $bling->categoriasProdutos()->buscar($idCategoria);
    } catch (\Exception $e) {
        // $e->getMessage();
    }
```

### Buscando todos as categorias de produtos
[Ver documentação](https://developer.bling.com.br/referencia#/Categorias%20-%20Produtos/get_categorias_produtos)
```php
    use PabloSanches\Bling\Client;
    
    try {
        $blingClient = Client::factory('<seu-token-aqui>');
        $response = $bling->categoriasProdutos()->buscarTodos();
    } catch (\Exception $e) {
        // $e->getMessage();
    }
```

### Removendo uma categoria de produto
[Ver documentação](https://developer.bling.com.br/referencia#/Categorias%20-%20Produtos/delete_categorias_produtos__idCategoriaProduto_)
```php
    use PabloSanches\Bling\Client;
    
    try {
        $blingClient = Client::factory('<seu-token-aqui>');
        $idCategoria = 123456789;
        $response = $bling->categoriasProdutos()->remover($idCategoria);
    } catch (\Exception $e) {
        // $e->getMessage();
    }
```

## Categorias Lojas
*(Multilojas)*

[Ver documentação](https://developer.bling.com.br/referencia#/Categorias%20-%20Lojas)

Para utilizar recursos do multilojas, você precisa especificar o parâmetro ***multilojas*** na construção do Client da SDK.

Exemplo:
```php
use PabloSanches\Bling\Client;
$blingClient = Client::factory('<seu-token-aqui>', ['multilojas' => '<id-integracao-aqui>']);
```

### Criando um vínculo de uma categoria de produto
[Ver documentação](https://developer.bling.com.br/referencia#/Categorias%20-%20Lojas/post_categorias_lojas)
```php
    use PabloSanches\Bling\Client;
    
    try {
        $blingClient = Client::factory('<seu-token-aqui>', '<id-integracao-aqui>');
        $payload = [
            'descricao' => 'Categoria de produto vinculado à loja',
            'codigo' => '12345678',
            'categoriaProduto' => ['id' => 12345678]
        ];
        $response = $bling->categoriasLojas()->criar($payload);
    } catch (\Exception $e) {
        // $e->getMessage();
    }
```

### Atualizando um vínculo de uma categoria de produto
[Ver documentação](https://developer.bling.com.br/referencia#/Categorias%20-%20Lojas/put_categorias_lojas__idCategoriaLoja_)
```php
    use PabloSanches\Bling\Client;
    
    try {
        $blingClient = Client::factory('<seu-token-aqui>', '<id-integracao-aqui>');
        $payload = [
            'descricao' => 'Categoria de produto vinculado à loja',
            'codigo' => '12345678',
            'categoriaProduto' => ['id' => 12345678]
        ];
        $idVinculo = 123456789;
        $response = $bling->categoriasLojas()->atualizar($idVinculo, $payload);
    } catch (\Exception $e) {
        // $e->getMessage();
    }
```

### Buscando um vínculo de categoria de produto pelo seu ID
[Ver documentação](https://developer.bling.com.br/referencia#/Categorias%20-%20Lojas/get_categorias_lojas__idCategoriaLoja_)
```php
    use PabloSanches\Bling\Client;
    
    try {
        $blingClient = Client::factory('<seu-token-aqui>', '<id-integracao-aqui>');
        $idVinculo = 123456789;
        $response = $bling->categoriasLojas()->buscar($idVinculo);
    } catch (\Exception $e) {
        // $e->getMessage();
    }
```

### Buscando todos os vínculos de categorias de produtos
[Ver documentação](https://developer.bling.com.br/referencia#/Categorias%20-%20Lojas/get_categorias_lojas)
```php
    use PabloSanches\Bling\Client;
    
    try {
        $blingClient = Client::factory('<seu-token-aqui>', '<id-integracao-aqui>');
        $idVinculo = 123456789;
        $response = $bling->categoriasLojas()->buscarTodos();
    } catch (\Exception $e) {
        // $e->getMessage();
    }
```

### Removendo um vínculo de uma categoria de produto
[Ver documentação](https://developer.bling.com.br/referencia#/Categorias%20-%20Lojas/delete_categorias_lojas__idCategoriaLoja_)
```php
    use PabloSanches\Bling\Client;
    
    try {
        $blingClient = Client::factory('<seu-token-aqui>', '<id-integracao-aqui>');
        $idVinculo = 123456789;
        $response = $bling->categoriasLojas()->remover($idVinculo);
    } catch (\Exception $e) {
        // $e->getMessage();
    }
```