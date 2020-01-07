## Bee Pagamentos PHP

A [Bee Pagamentos](https://bee.cash) PHP é uma biblioteca desenvolvida para php com intuito de facilitar a conexão entre os desenvolvedores e a Bee.    

A simplicidade é nosso lema, pois com poucas linhas de código você consegue transferir dinheiro para qualquer usuário cadastrado na [Bee Pagamentos](https://bee.cash).    

Veja como é simples fazer uma transferência:  

```php
	// Chamando a Bee Pagamentos PHP
	require 'src/bee.php';

	// Criando a instancia
	$bee_sdk = new Bee('seu-token');

	// Criando a transferencia
	$transferencia = $bee_sdk->transfer_create([
		'username' => 'usuario-destino', // Usuário da Bee Pagamentos
		'amount' => 100, // Valor a ser transferido
		'coin' => 'brl', // Moeda que deseja transferir
	]);
```  

Simples assim!  
Sua transferência foi criada e se tudo correr bem este será seu retorno:  

```
	{
		"success": true
		"result": {
			"amount": 100
			"coin": "brl"
			"proof": "q1N4-spvY-d0T1-9RQ9"
			"created_at": "2020-01-03T14:31:23.871699Z"
		}
	}
```  

#### Retorno da transferência  

Campo | Tipo | Valor | Descrição
:----:|:----:|:-----:|:---------:
success | Boolean | **true** ou **false** | **true** em caso de sucesso e **false** em caso de falha
result | Array | **array** | array com os dados da transação
result.amount | Float | **float** | valor que foi transferido
result.coin | String | **string** | moeda utilizada na transferência
result.proof | String | **string** | comprovante da tranferência, utilizado para localizar a transferência.
result.created_at | Timestamp | **timestamp** | data da criação da tranferência

##### Confira a documentação completa [clicando aqui](https://github.com/bee-payments/sdk-php/blob/master/docs/pt.md)