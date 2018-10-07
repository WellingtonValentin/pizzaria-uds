**API - Pizzaria UDS**
=======
**Autor**

Wellington Valentin Salatta

-------

**Objetivos**

Api simplificada de pedidos de Pizza vizando atender os requisitos do teste de adimição para vaga de programador. Utilizando o framework laravel a aplicação irá exibir opções de tamanho, sabor e personalização de pizzas e permitir que o usuário escolha como quer montar a sua pizza e ao final exibir os detalhes do pedido.

-------

**Como executar a aplicação**

A aplicação foi desenvolvida utilizando o framework laravel. Portanto seu servidor deve possuir os seguintes requerimentos.

PHP >= 7.0

OpenSSL PHP Extension

PDO PHP Extension

Mbstring PHP Extension

Tokenizer PHP Extension

XML PHP Extension

Ctype PHP Extension

JSON PHP Extension

Tendo atendido aos requerimentos, após clonar o projeto basta se dirigir ao diretório raiz do projeto e efetuar o comando:

`php artisan serve`

Para configurar as conexões de banco de dados basta abrir o arquivo /api/.env e modificar os campos DB_HOST, DB_DATABASE, DB_USERNAME, DB_PASSWORD

Para o banco de dados, junto aos arquivos deste projeto a um backup do banco atualizado, porém caso prefira basta executar o seguinte comando no terminal:

`php artisan migrate`

Lembrando que, caso prefira executar a migrate é necessário que o schema configurado no arquivo .env já esteja criado.

Para conferir que a aplicação está rodando corretamente basta mandar uma requisição GET através do POSTMAN para a url de seu localhost ou virtual host configurado para o projeto. A api deverá retornar a seguinte mensagem se estiver tudo certo.

    {
     "message": "Pizzaria UDS - API",
     "status": "Connected"
    }
 
 -------
 
 **Como utilizar a api**
 
 Está api foi imaginada considerando etapas de montagem para a pizza, cada etapa será detalhada a seguir.
 
 **1 - Montagem da pizza**
 
 Esta etapa tem por objetivo fornecer ao cliente opções de tamanhos e sabores de pizzas para que ele possa selecionar da forma que desejar.
 
 Para obter a lista de tamanhos e sabores disponíveis bastar enviar uma requisição GET para o endereço:
 
 `http://localhost:8000/api/pedido_montagem`
 
 A aplicação deverá retornar um json com o seguinte formato.
 
 
 
    {
      "tamanhos": [
          {
              "id": 1,
              "descricao": "Pequena",
              "valor": 20,
              "tempo_adicional": "00:15:00"
          },
          {
              "id": 2,
              "descricao": "Média",
              "valor": 30,
              "tempo_adicional": "00:20:00"
          },
          {
              "id": 3,
              "descricao": "Grande",
              "valor": 40,
              "tempo_adicional": "00:25:00"
          }
      ],
      "sabores": [
          {
              "id": 1,
              "descricao": "Calabresa",
              "tempo_adicional": "00:00:00"
          },
          {
              "id": 2,
              "descricao": "Marguerita",
              "tempo_adicional": "00:00:00"
          },
          {
              "id": 3,
              "descricao": "Portuguesa",
              "tempo_adicional": "00:05:00"
          }
      ]
    }
  
  
  
  De posse das opções de tamanhos e sabores o cliente pode então selecionar o que desejar, então deverá ser enviado para a api o seguinte modelo de json para que o pedido possa ser salvo no banco.
  
  
  
    {
     "tamanho": 
          {
              "id": 3,
              "descricao": "Grande",
              "valor": 40,
              "tempo_adicional": "00:25:00"
          }
      ,
      "sabor": 
          {
              "id": 1,
              "descricao": "Calabresa",
              "tempo_adicional": "00:00:00"
          }
    }
  
  
  
  O pedido será salvo internamente no banco e será retornado o id do pedido que será necessário para a próxima etapa.
  
  **2 - Personalização do Pedido**
  
  Esta etapa tem por objetivo exibir ao cliente opções de personalização de seu pedido, para receber a lista de opções disponíveis basta enviar uma requisição GET para o endereço:
  
  `http://localhost:8000/api/pedido_personalizacao`
  
  Uma lista com as opções será exibida seguindo o seguinte modelo.
  
  
    {
      "personalizacao": [
          {
              "id": 1,
              "descricao": "Extra Bacon",
              "valor": 3,
              "tempo_adicional": "00:00:00"
          },
          {
              "id": 2,
              "descricao": "Sem Cebola",
              "valor": 0,
              "tempo_adicional": "00:00:00"
          },
          {
              "id": 3,
              "descricao": "Borda Recheada",
              "valor": 5,
              "tempo_adicional": "00:05:00"
          }
      ]
    }
  
  
  
  Para salvar junto ao pedido as opções de personalização pede-se que seja enviado uma requisição POST utilizando o id fornecido na etapa anterior e o json com as opções desejadas, tanto endereço que deve ser utilizado com o modelo de json está logo abaixo.
  
  `http://localhost:8000/api/pedido_personalizacao/{id}`
  
  
    {
     "tamanho": 
          {
              "id": 3,
              "descricao": "Grande",
              "valor": 40,
              "tempo_adicional": "00:25:00"
          }
      ,
      "sabor": 
          {
              "id": 1,
              "descricao": "Calabresa",
              "tempo_adicional": "00:00:00"
          },
      "personalizacao": [
          {
              "id": 1,
              "descricao": "Extra Bacon",
              "valor": 3,
              "tempo_adicional": "00:00:00"
          },
          {
              "id": 2,
              "descricao": "Sem Cebola",
              "valor": 0,
              "tempo_adicional": "00:00:00"
          },
          {
              "id": 3,
              "descricao": "Borda Recheada",
              "valor": 5,
              "tempo_adicional": "00:05:00"
          }
      ]
    }
  
  
  Observa-se que no modelo as opções de personalização são passadas em um array chamado personalizacao, este array não é obrigatório e caso não seja informado pode-se passar para a próxima etapa normalmente, foi criado também uma validação para que caso seja passado IDs inexistente ou repetidos para o que não seja salvo a opção não encontrada ou repetida.
  
  Uma vez salvo as opções de personalização será novamente retornado o id do pedido e poderemos seguir para a etapa final.
  
  **3 - Resumo do Pedido**
  
  Uma vez estando concluído o processo do pedido, deve-se enviar uma requisição GET para a api utilizando o id retornado para o pedido.
  
  Segue o modelo do endereço e do retorno.
  
  `http://localhost:8000/api/pedido/{id}`
  
    {
      "id": 13,
      "situacao": "Finalizado",
      "valor_total": 48,
      "tempo_total": "00:30",
      "tamanho": {
          "id": 3,
          "descricao": "Grande",
          "valor": 40,
          "tempo_adicional": "00:25:00"
      },
      "sabor": {
          "id": 1,
          "descricao": "Calabresa",
          "tempo_adicional": "00:00:00"
      },
      "personalizacao": [
          {
              "id": 1,
              "descricao": "Extra Bacon",
              "valor": 3,
              "tempo_adicional": "00:00:00"
          },
          {
              "id": 2,
              "descricao": "Sem Cebola",
              "valor": 0,
              "tempo_adicional": "00:00:00"
          },
          {
              "id": 3,
              "descricao": "Borda Recheada",
              "valor": 5,
              "tempo_adicional": "00:05:00"
          }
      ]
    }
    
Pode-se observar que o valor total do pedido e o tempo total de preparo são discrimindos dos respectivos campos valor_total e tempo_total.

-------

**Agradecimentos**

Agradeço a empresa solicitante do teste a oportunidade de demonstrar meus conhecimentos e habilidades com ferramentas de desenvolvimento, espero que possamos vir a trabalhar juntos e que este seja apenas o primeiro passo de uma relação duradoura e benefica para ambos os lados.