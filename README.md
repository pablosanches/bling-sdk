![alt text](https://developer.bling.com.br/build/assets/developer-0085d380.svg)
# Bling! - API v3
![Workflow](https://github.com/pablosanches/bling-sdk/actions/workflows/master.yml/badge.svg)
Esta é uma SDK **não** oficial que facilita a integração com o [Bling!](https://developer.bling.com.br/bling-api#introdu%C3%A7%C3%A3o) utilizando a API V3.

Pule para:
* [Introdução](#Introdução)
* [Contatos](#Contatos)

## Introdução
A API V3 do [Bling!](https://developer.bling.com.br/bling-api#introdu%C3%A7%C3%A3o) utiliza do modelo de autenticação OAuth 2.0, sendo assim, antes de qualquer coisa você precisará registrar um aplicativo em sua conta do Bling! para conseguir realizar todas as etapas de autenticação, você pode saber mais [aqui!](https://developer.bling.com.br/aplicativos#introdu%C3%A7%C3%A3o)

Esta SDK segue um padrão de roteamento dinâmico baseado nos módulos implementados, desta forma, você precisará construir a instância de client da SDK e chamar seus módulos através deste client. 

Exemplo:
```php
    use PabloSanches\Bling\Client;
    
    try {
        $blingClient = Client::factory('seu-token-aqui');
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
        $blingClient = Client::factory('seu-token-aqui');
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
        $blingClient = Client::factory('seu-token-aqui');
        
        $filtros = [
            'pagina' => 1,
            'limite' => 100,
            'criterio' => 1,
            'dataInclusaoInicial' => '2024-01-01'
        ];
        
        $response = $bling->contatos()->todos($filtros);
    } catch (\Exception $e) {
        // $e->getMessage();
    }
```

## Contatos
[Ver documentação](https://developer.bling.com.br/referencia#/Contatos)

### Criando um contato:
[Ver documentação](https://developer.bling.com.br/referencia#/Contatos/post_contatos)
```php
    use PabloSanches\Bling\Client;
    
    try {
        $blingClient = Client::factory('seu-token-aqui');
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
        $blingClient = Client::factory('seu-token-aqui');
        $payload = [
            'nome' => 'Pablo Sanches'
        ];
        $response = $bling->contatos()->alterar($id, $payload);
    } catch (\Exception $e) {
        // $e->getMessage();
    }
    
```

### Buscando todos os contatos:
[Ver documentação](https://developer.bling.com.br/referencia#/Contatos/get_contatos)
```php
use PabloSanches\Bling\Client;
    
    try {
        $blingClient = Client::factory('seu-token-aqui');
        
        $filtros = [
            'pagina' => 1,
            'limite' => 100,
            'criterio' => 1,
            'dataInclusaoInicial' => '2024-01-01'
        ];
        
        $response = $bling->contatos()->todos($filtros);
    } catch (\Exception $e) {
        // $e->getMessage();
    }
```

### Buscando contato por ID:
[Ver documentação](https://developer.bling.com.br/referencia#/Contatos/get_contatos__idContato_)
```php
use PabloSanches\Bling\Client;
    
    try {
        $blingClient = Client::factory('seu-token-aqui');
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
        $blingClient = Client::factory('seu-token-aqui');
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
        $blingClient = Client::factory('seu-token-aqui');
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
        $blingClient = Client::factory('seu-token-aqui');
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
        $blingClient = Client::factory('seu-token-aqui');
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
        $blingClient = Client::factory('seu-token-aqui');
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
        $blingClient = Client::factory('seu-token-aqui');
        $idsContatos = [1, 2, 3, 4];
        $response = $bling->contatos()->removerMultiplos($idContato);
    } catch (\Exception $e) {
        // $e->getMessage();
    }
```