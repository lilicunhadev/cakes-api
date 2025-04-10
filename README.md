## CAKES API

<b>CAKES API</b> é um projeto de uma <b>API REST</b> de cadastro de bolos, em que cadastramos os dados do bolo, a quantidade e os e-mails de clientes interessados.
Após o cadastro do bolo o sistema envia e-mails para os clientes interessados com a disponibilidade do bolo.

### Instruções de instalação:

- Clonar o projeto laravel;
- Abrir um terminal dentro da pasta do projeto e digitar o comando: "php artisan key:generate";
- Depois digitar o comando: "composer install";
- Editar o arquivo .env:
- <b>DB_CONNECTION=sqlite</b>
- <b>DB_DATABASE=/caminho completo do sistema até o arquivo/cakes-api/database/database.sqlite</b>
- Rodar o comando no terminal: "php artisan migrate";
- Rodar o comando: "php artisan serve" para rodar o projeto.
