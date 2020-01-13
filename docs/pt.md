# Bee PHP

É uma biblioteca desenvolvida para php com intuito de facilitar a conexão entre os desenvolvedores e a [Bee](https://bee.cash).  

## Confira as moedas aceitas pela [Bee](https://bee.cash)  

| Nome | Código da moeda |
|:------|:-----:|
| Bitcoin | btc |
| Litecoin | ltc |
| Dogecoin | doge |
| Real | brl |  

**Observação:** O campo **Código da moeda** informado na tabela acima equivale ao campo **coin** nos metódos que você irá conhecer abaixo.  

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
      "url": "https://google.com"
   }
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
      "url": "https://google.com"
   }
}
```

## **_balance_**

Responsável por buscar o saldo da sua conta.  

**Parâmetros**

| Campo | Tipo | Obrigatório | Descrição |
|:------|:-----|:-----------:|:----------|
| coin | string | não | moeda na qual você quer buscar o saldo. |

**Retorno (informando a moeda[coin])**

Campo | Tipo | Descrição
:----|:----|:---------
success | boolean  | **true** em caso de sucesso  **false** em caso de falha. |
errors | array | erros ocorridos durante a solicitação. este campo só existirá caso success seja **false**. |
result | array | array com o saldo da moeda informada. |
result&#160;&#x2011;>&#160;amount | float | saldo disponível. |
result&#160;&#x2011;>&#160;blocked | float | saldo bloqueado. |
result&#160;&#x2011;>&#160;updated_at | timestamp | data da última atualização. |

**Retorno (não informando a moeda[coin])**

Campo | Tipo | Descrição
:----|:----|:---------
success | boolean  | **true** em caso de sucesso  **false** em caso de falha. |
errors | array | erros ocorridos durante a solicitação. este campo só existirá caso success seja **false**. |
result | array | array com o saldo de todas as moedas disponíveis. |
result&#160;&#x2011;>&#160;[coin]&#160;&#x2011;>&#160;amount | float | saldo disponível. |
result&#160;&#x2011;>&#160;[coin]&#160;&#x2011;>&#160;blocked | float | saldo bloqueado. |
result&#160;&#x2011;>&#160;[coin]&#160;&#x2011;>&#160;updated_at | timestamp | data da última atualização. |

#### Exemplo (informando a moeda[coin]):

**1: Buscar saldo**
```php
$saldo = $bee->balance('btc');
```

**Retorno:**
```json
{
   "success": true,
   "result": {
      "amount": 0.002,
      "blocked": 0.0005,
      "updated_at": "2020-01-03T14:31:23.871699Z"
   }
}
```

#### Exemplo (não informando a moeda[coin]):

**1: Buscar saldo**
```php
$saldo = $bee->balance();
```

**Retorno:**
```json
{
   "success": true,
   "result": [
      {
         "btc": {
            "amount": 0.002,
            "blocked": 0.0005,
            "updated_at": "2020-01-03T14:31:23.871699Z"
         },
         "ltc": {
            "amount": 0.125,
            "blocked": 0,
            "updated_at": "2020-01-03T14:31:23.871699Z"
         }
      }
   ]
}
```

## **_coin_list_**

Responsável por listar todas as moedas aceitas pela [Bee](https://bee.cash).  

**Parâmetros**

nenhum.

**Retorno**

Campo | Tipo | Descrição
:----|:----|:---------
success | boolean  | **true** em caso de sucesso  **false** em caso de falha. |
errors | array | erros ocorridos durante a solicitação. este campo só existirá caso success seja **false**. |
result | array | array com todas as moedas disponíveis. |
result&#160;&#x2011;>&#160;[index]&#160;&#x2011;>&#160;coin | string | identificador do saque. |
result&#160;&#x2011;>&#160;[index]&#160;&#x2011;>&#160;name | string | nome da moeda. |
result&#160;&#x2011;>&#160;[index]&#160;&#x2011;>&#160;is_altcoin | boolean | indica se a moeda é uma altcoin. |
result&#160;&#x2011;>&#160;[index]&#160;&#x2011;>&#160;places | integer | quantidade de casas decimais, utilizado para formatar números. |
result&#160;&#x2011;>&#160;[index]&#160;&#x2011;>&#160;fees | array | array com dados das taxas com valor fixo e/ou porcentagem. |
result&#160;&#x2011;>&#160;[index]&#160;&#x2011;>&#160;fees&#160;&#x2011;>&#160;fixed | array | array com dados da taxa fixa da moeda. |
result&#160;&#x2011;>&#160;[index]&#160;&#x2011;>&#160;fees&#160;&#x2011;>&#160;fixed&#160;&#x2011;>&#160;deposit | float | taxa para depósitos. |
result&#160;&#x2011;>&#160;[index]&#160;&#x2011;>&#160;fees&#160;&#x2011;>&#160;fixed&#160;&#x2011;>&#160;transfer_receipt | float | taxa para transferências recebidas. |
result&#160;&#x2011;>&#160;[index]&#160;&#x2011;>&#160;fees&#160;&#x2011;>&#160;fixed&#160;&#x2011;>&#160;transfer_send | float | taxa para transferências enviadas. |
result&#160;&#x2011;>&#160;[index]&#160;&#x2011;>&#160;fees&#160;&#x2011;>&#160;fixed&#160;&#x2011;>&#160;withdrawal | float | taxa para saques. |
result&#160;&#x2011;>&#160;[index]&#160;&#x2011;>&#160;fees&#160;&#x2011;>&#160;percentage | array | array com dados da taxa fixa da moeda. |
result&#160;&#x2011;>&#160;[index]&#160;&#x2011;>&#160;fees&#160;&#x2011;>&#160;percentage&#160;&#x2011;>&#160;deposit | float | taxa para depósitos. |
result&#160;&#x2011;>&#160;[index]&#160;&#x2011;>&#160;fees&#160;&#x2011;>&#160;percentage&#160;&#x2011;>&#160;transfer_receipt | float | taxa para transferências recebidas. |
result&#160;&#x2011;>&#160;[index]&#160;&#x2011;>&#160;fees&#160;&#x2011;>&#160;percentage&#160;&#x2011;>&#160;transfer_send | float | taxa para transferências enviadas. |
result&#160;&#x2011;>&#160;[index]&#160;&#x2011;>&#160;fees&#160;&#x2011;>&#160;percentage&#160;&#x2011;>&#160;withdrawal | float | taxa para saques. |
result&#160;&#x2011;>&#160;[index]&#160;&#x2011;>&#160;limits | array | array com dados dos seus limites. |
result&#160;&#x2011;>&#160;[index]&#160;&#x2011;>&#160;limits&#160;&#x2011;>&#160;minimum | array | array com dados dos limites mínimos. |
result&#160;&#x2011;>&#160;[index]&#160;&#x2011;>&#160;limits&#160;&#x2011;>&#160;minimum&#160;&#x2011;>&#160;deposit | float | limite mínimo para depósito. |
result&#160;&#x2011;>&#160;[index]&#160;&#x2011;>&#160;limits&#160;&#x2011;>&#160;minimum&#160;&#x2011;>&#160;transfer | float | limite mínimo para transferência. |
result&#160;&#x2011;>&#160;[index]&#160;&#x2011;>&#160;limits&#160;&#x2011;>&#160;minimum&#160;&#x2011;>&#160;withdrawal | float | limite mínimo para saque. |
result&#160;&#x2011;>&#160;[index]&#160;&#x2011;>&#160;limits&#160;&#x2011;>&#160;maximum | array | array com dados dos limites mínimos. |
result&#160;&#x2011;>&#160;[index]&#160;&#x2011;>&#160;limits&#160;&#x2011;>&#160;maximum&#160;&#x2011;>&#160;deposit | float | limite máximo para depósito. |
result&#160;&#x2011;>&#160;[index]&#160;&#x2011;>&#160;limits&#160;&#x2011;>&#160;maximum&#160;&#x2011;>&#160;transfer | float | limite máximo para transferência. |
result&#160;&#x2011;>&#160;[index]&#160;&#x2011;>&#160;limits&#160;&#x2011;>&#160;maximum&#160;&#x2011;>&#160;withdrawal | float | limite máximo para saque. |

#### Exemplo:

**1: Buscar moedas**
```php
$moedas = $bee->list_coins();
```

**Retorno:**
```json
{
  "success": true,
  "result": [
    {
      "coin": "brl",
      "name": "reais",
      "is_altcoin": false,
      "places": 2,
      "fees": {
        "fixed": {
          "deposit": 0,
          "transfer_receipt": 0,
          "transfer_send": 0,
          "withdrawal": 0
        },
        "percentage": {
          "deposit": 0,
          "transfer_receipt": 0,
          "transfer_send": 0,
          "withdrawal": 0
        }
      },
      "limits": {
        "minimum": {
          "deposit": 0,
          "transfer": 0,
          "withdrawal": 0
        },
        "maximum": {
          "deposit": 0,
          "transfer": 0,
          "withdrawal": 0
        }
      }
    },
    {
      "coin": "btc",
      "name": "bitcoin",
      "is_altcoin": true,
      "places": 8,
      "fees": {
        "fixed": {
          "deposit": 0,
          "transfer_receipt": 0,
          "transfer_send": 0,
          "withdrawal": 0
        },
        "percentage": {
          "deposit": 0,
          "transfer_receipt": 0,
          "transfer_send": 0,
          "withdrawal": 0
        }
      },
      "limits": {
        "minimum": {
          "deposit": 0,
          "transfer": 0,
          "withdrawal": 0
        },
        "maximum": {
          "deposit": 0,
          "transfer": 0,
          "withdrawal": 0
        }
      }
    }
  ]
}
```
