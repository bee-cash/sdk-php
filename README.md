## Bee PHP

É uma biblioteca desenvolvida para php com intuito de facilitar a conexão entre os desenvolvedores e a [Bee](https://bee.cash).    

A simplicidade é nosso lema, pois com poucas linhas de código você consegue transferir dinheiro para qualquer usuário cadastrado na [Bee](https://bee.cash).    

Veja como é simples fazer uma transferência:  

**1: Inclua a biblioteca**
```php
require 'src/bee.php';
```  

**2: Inicie a instância** 
```php
$bee = new Bee('seu-token');	
```  

**3: Crie uma tranferência**

```php
$bee->transfer_create([
	'username' => 'usuario-destino', // Usuário da Bee Pagamentos
	'amount' => 100, // Valor a ser transferido
	'coin' => 'brl', // Moeda que deseja transferir
]);
```  

Simples assim!  
Sua transferência foi criada e se tudo correr bem este será seu retorno:  

```json
{
	"success": true,
	"result": {
		"amount": 100,
		"coin": "brl",
		"proof": "q1N4-spvY-d0T1-9RQ9",
		"created_at": "2020-01-03T14:31:23.871699Z",
	}
}
```  

Campo | Tipo | Descrição
:----|:----|:---------
success | boolean  | **true** em caso de sucesso  **false** em caso de falha. |
result | array | array com os dados da transação. |
result&#160;&#x2011;>&#160;amount | float | valor que foi transferido. |
result&#160;&#x2011;>&#160;coin | string | moeda utilizada na transferência. |
result&#160;&#x2011;>&#160;proof | string | comprovante da tranferência, utilizado para localizar a transferência. |
result&#160;&#x2011;>&#160;created_at | timestamp | data da criação da tranferência.|

##### Confira a documentação completa [clicando aqui](https://github.com/bee-payments/sdk-php/blob/master/docs/pt.md).