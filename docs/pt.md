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
| coin | string | sim | código da moeda na qual o endereço deve ser gerado. |
| url | string | não | url para envio das notificações de depósito referêntes a este endereço. |
| secret | string | não | código secreto que será enviado junto as notificações para url acima. |
| label | string | não | nome de identificação do endereço. |

**Retorno**

Campo | Tipo | Descrição
:----|:----|:---------
success | boolean  | **true** em caso de sucesso  **false** em caso de falha. |
errors | array | erros ocorridos durante a solicitação. este campo só existirá caso success seja **false**. |
result | array | array com os dados do endereço criado. |

#### Exemplo:

```php
$bee->altcoin_address_create([
   'coin' => 'btc',
   'url' => 'https://google.com',
   'secret' => '4gB6',
   'label' => 'Endereco BTC'
]);
```

## **_altcoin_withdrawal_create_**

Responsável por realizar saques de altcoins.  

**Parâmetros**

| Campo | Tipo | Obrigatório | Descrição |
|:------|:-----|:-----------:|:----------|
| address | string | sim | endereço para onde será enviado o saque. |
| amount | decimal | sim | valor do saque. |
| coin | string | sim | código da moeda na qual o endereço deve ser gerado. |
| url | string | não | url para envio das notificações desta retirada. |
| secret | string | não | código secreto que será enviado junto as notificações para url acima. |
| label | string | não | nome de identificação da retirada. |

**Retorno**

Campo | Tipo | Descrição
:----|:----|:---------
success | boolean  | **true** em caso de sucesso  **false** em caso de falha. |
errors | array | erros ocorridos durante a solicitação. este campo só existirá caso success seja **false**. |
result | array | array com os dados da retirada. |

#### Exemplo:

```php
$bee->altcoin_withdrawal_create([
   'address' => '18cBEMRxXHqzWWCxZNtU91F5sbUNKhL5PX',
   'amount' => 0.01,
   'coin' => 'btc',
   'url' => 'https://google.com',
   'secret' => '15f6b',
   'label' => 'saque para minha carteira'
]);
```

## **_balance_**

Responsável por buscar o saldo da sua conta.  

**Parâmetros**

| Campo | Tipo | Obrigatório | Descrição |
|:------|:-----|:-----------:|:----------|
| coin | string | não | código da moeda na qual você quer buscar o saldo. |

**Retorno (informando o código da moeda)**

Campo | Tipo | Descrição
:----|:----|:---------
success | boolean  | **true** em caso de sucesso  **false** em caso de falha. |
errors | array | erros ocorridos durante a solicitação. este campo só existirá caso success seja **false**. |
result | array | array com o saldo da moeda informada. |

**Retorno (não informando o código da moeda)**

Campo | Tipo | Descrição
:----|:----|:---------
success | boolean  | **true** em caso de sucesso  **false** em caso de falha. |
errors | array | erros ocorridos durante a solicitação. este campo só existirá caso success seja **false**. |
result | array | array com o saldo de todas as moedas disponíveis. |

#### Exemplo:

```php
$bee->balance('btc');
```

```php
$bee->balance();
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

#### Exemplo:

```php
$bee->coin_list();
```

## **_coin_info_**

Responsável por buscar as informações de uma moeda.  

**Parâmetros**

| Campo | Tipo | Obrigatório | Descrição |
|:------|:-----|:-----------:|:----------|
| coin | string | sim | moeda que deseja obter informações. |

**Retorno**

Campo | Tipo | Descrição
:----|:----|:---------
success | boolean  | **true** em caso de sucesso  **false** em caso de falha. |
errors | array | erros ocorridos durante a solicitação. este campo só existirá caso success seja **false**. |
result | array | array com os dados da moeda. |

#### Exemplo:

```php
$bee->coin_info('btc');
```

## **_invoice_create_**

Responsável por criar faturas para pagamento.  
Geralmente utilizado para que seus clientes façam pagamentos dentro [Bee](https://bee.cash) e seu sistema seja avisado deste pagamento.  
**O usuário pode realizar o pagamento de qualquer valor.**  

**Parâmetros**

| Campo | Tipo | Obrigatório | Descrição |
|:------|:-----|:-----------:|:----------|
| coin | string | sim | código da moeda na qual a fatura deve ser gerada. |
| amount | float | não | valor sugerido para pagamento desta fatura. |
| url | string | não | url para envio das notificações de depósito referêntes a esta fatura. |
| secret | string | não | código secreto que será enviado junto as notificações para url acima. |
| label | string | não | nome de identificação da fatura. |

**Retorno**

Campo | Tipo | Descrição
:----|:----|:---------
success | boolean  | **true** em caso de sucesso  **false** em caso de falha. |
errors | array | erros ocorridos durante a solicitação. este campo só existirá caso success seja **false**. |
result | array | array com os dados da fatura criada. |

#### Exemplo:

```php
$bee->invoice_create([
   'coin' => 'btc',
   'amount' => 100,
   'url' => 'https://google.com',
   'secret' => 'gG53',
   'label' => 'Fatura do meu CRM'
]);
```
