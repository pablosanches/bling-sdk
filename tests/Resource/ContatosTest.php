<?php

namespace PabloSanches\Bling\Resource;

use PabloSanches\Bling\BaseTesting;

class ContatosTest extends BaseTesting
{
    public function testCreateContato(): void
    {
        $blingClient = $this->getBlingClient();
        $payload = $this->getPayload('contatos/request/criar-contato.json');
        $response = $blingClient->contatos()->criar($payload);
        exit(var_dump($response));
    }
}
