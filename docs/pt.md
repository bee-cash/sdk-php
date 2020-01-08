# Bee PHP

É uma biblioteca desenvolvida para php com intuito de facilitar a conexão entre os desenvolvedores e a [Bee](https://bee.cash).  

## Como usar?

Para começar a usar a biblioteca, você precisa ter um cadastro na [Bee](https://bee.cash) e gerar o seu token de acesso.  

Agora que você possui seu token, vamos conectar a biblioteca:

**1: Inclua a biblioteca**
```php
require 'src/bee.php';
```  

**2: Inicie a instância** 
```php
$bee = new Bee('seu-token');	
```  

Pronto nossa biblioteca está conectada com a [Bee](https://bee.cash).  

Agora vamos conhecer os metódos disponíveis:

## **_altcoin_address_create_**

Responsável por criar endereços de depósito para altcoins.  

**Parâmetros**

| Campo | Tipo | Obrigatório | Descrição |
|:------|:-----|:-----------:|:----------|
| coin | string | sim | moeda na qual o endereço deve ser gerado. |
| url | string | não | url para envio das notificações de depósito referêntes a este endereço. |
| secret | string | não | código secreto que será enviado junto as notificações para url acima. |
| label | string | não | nome de identificação do endereço. |

**Retorno**

Campo | Tipo | Descrição
:----|:----|:---------
success | boolean  | **true** em caso de sucesso  **false** em caso de falha. |
errors | array | erros ocorridos durante a solicitação. este campo só existirá caso success seja **false**. |
result | array | array com os dados da transação. |
result&#160;&#x2011;>&#160;address | string | endereço criado. |
result&#160;&#x2011;>&#160;coin | string | moeda relacionada a este endereço. |
result&#160;&#x2011;>&#160;label | string | nome de identificação do endereço. |
result&#160;&#x2011;>&#160;url | string | para envio das notificações de depósito referêntes a este endereço. |
result&#160;&#x2011;>&#160;secret | string | que será enviado junto as notificações para url acima .|

#### Exemplo:

**1: Criar o endereco**
```php
$endereco = $bee->altcoin_address_create([
   'coin' => 'btc',
   'url' => 'https://google.com',
   'secret' => '4gB6',
   'label' => 'Endereco BTC'
]);
```

**Retorno:**
```json
{
   "success": true,
   "result": {
      "address": "18cBEMRxXHqzWWCxZNtU91F5sbUNKhL5PX",
      "coin": "btc",
      "label": "Endereco BTC",
      "secret": "4gB6",
      "url": "https://google.com",
   }
}
```

**Utilizando o retorno:**
```php
if($endereco['success']){
   echo $endereco['result']['address'];
}
```

## **_altcoin_withdrawal_create_**

Responsável por realizar saques de altcoins.  

**Parâmetros**

| Campo | Tipo | Obrigatório | Descrição |
|:------|:-----|:-----------:|:----------|
| address | string | sim | endereço para onde será enviado o saque. |
| amount | decimal | sim | valor do saque. |
| coin | string | sim | moeda na qual o endereço deve ser gerado. |
| url | string | não | url para envio das notificações desta retirada. |
| secret | string | não | código secreto que será enviado junto as notificações para url acima. |
| label | string | não | nome de identificação da retirada. |

**Retorno**

Campo | Tipo | Descrição
:----|:----|:---------
success | boolean  | **true** em caso de sucesso  **false** em caso de falha. |
errors | array | erros ocorridos durante a solicitação. este campo só existirá caso success seja **false**. |
result | array | array com os dados da transação. |
result&#160;&#x2011;>&#160;id | integer | identificador do saque. |
result&#160;&#x2011;>&#160;address | string | endereço que recebeu o saque. |
result&#160;&#x2011;>&#160;amount | decimal | valor do saque. |
result&#160;&#x2011;>&#160;coin | string | moeda relacionada a este endereço. |
result&#160;&#x2011;>&#160;fee | decimal | taxa cobrada pelo saque. |
result&#160;&#x2011;>&#160;secret | string | que será enviado junto as notificações para url acima .|
result&#160;&#x2011;>&#160;url | string | para envio das notificações de depósito referêntes a este endereço. |

#### Exemplo:

**1: Criar o saque**
```php
$saque = $bee->altcoin_withdrawal_create([
   'address' => '18cBEMRxXHqzWWCxZNtU91F5sbUNKhL5PX',
   'amount' => 0.01,
   'coin' => 'btc',
   'url' => 'https://google.com',
   'secret' => '15f6b',
   'label' => 'saque para minha carteira'
]);
```

**Retorno:**
```json
{
   "success": true,
   "result": {
      "id": 15,
      "address": "18cBEMRxXHqzWWCxZNtU91F5sbUNKhL5PX",
      "fee": 0.0001,
      "secret": "15f6b",
      "url": "https://google.com",
   }
}
```

**Utilizando o retorno:**
```php
if($saque['success']){
   echo $saque['result']['fee'];
}
```