## CAKES API

Este é um projeto de uma <b>API REST</b> de cadastro de bolos, em que cadastramos os dados do bolo, a quantidade e os e-mails de clientes interessados.
Após o cadastro do bolo o sistema envia e-mails para os clientes interessados com a disponibilidade do bolo.

### Instruções de instalação:

- Clonar este projeto Laravel;
- Abrir um terminal dentro da pasta do projeto e digitar o comando: "php artisan key:generate";
- Depois digitar o comando: "composer install";
- Dentro da pasta do projeto database, criar um arquivo vazio chamado: database.sqlite;
- Editar o arquivo .env:
- <b>DB_CONNECTION=sqlite</b>
- <b>DB_DATABASE=/caminho completo do sistema até o arquivo/cakes-api/database/database.sqlite</b>
- Rodar o comando no terminal: "php artisan migrate";
- E depois: "php artisan serve".

### Documentação da API:
- Na raiz do projeto, o arquivo <i>cakes-api-doc.json</i> contém a documentação da API;
- Você pode visualizá-lo através do site <a>https://editor.swagger.io</a>;
- No site clique em “File” > “Import file”;
- Selecione o arquivo cakes-api-doc.json;
- Assim você poderá visualizar a documentação interativa do projeto.
