## CAKES API 🍰

Este é um projeto de uma <b>API REST</b> de cadastro de bolos, em que cadastramos os dados de cada bolo, como nome, valor, 
quantidade disponível e os e-mails de clientes interessados nesse bolo. <br/>
Após o cadastro o sistema envia e-mails para os clientes interessados com a disponibilidade do bolo em questão.

### Instruções de instalação:

- Clonar este projeto Laravel;
- Abrir um terminal dentro da pasta do projeto e digitar o comando: <b>"php artisan key:generate"</b>;
- Depois digitar o comando: <b>"composer install"</b>;
- Dentro da pasta do projeto database, criar um arquivo vazio chamado: <b>database.sqlite</b>;
- Editar o arquivo .env:
- <b>DB_CONNECTION=sqlite</b>
- <b>DB_DATABASE=/caminho completo do sistema até o arquivo/cakes-api/database/database.sqlite</b>
- Rodar o comando no terminal: <b>"php artisan migrate"</b>;
- E depois: <b>"php artisan serve"</b>.

### Documentação da API:
- Na raiz do projeto, o arquivo <b>cakes-api-doc.json</b> contém a documentação da API;
- Você pode visualizá-lo através do site <a>https://editor.swagger.io</a>;
- No site clique em “File” > “Import file”;
- Selecione o arquivo <b>cakes-api-doc.json</b>;
- Assim você poderá visualizar a documentação interativa do projeto.
