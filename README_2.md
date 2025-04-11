# CAKES API 🍰

Este é um projeto de uma **API REST** para o cadastro de bolos.  
A cada novo bolo cadastrado, o sistema armazena informações como: nome, valor, quantidade disponível e uma lista de e-mails de clientes interessados.

Se o bolo estiver disponível, o sistema **envia e-mails automaticamente** para os interessados utilizando **filas (queues)** do Laravel.

---

## 🚀 Instruções de instalação

1. Clone este repositório:
   ```bash
   git clone https://github.com/seu-usuario/laravel-api-bolos.git
   cd laravel-api-bolos
   ```

2. Instale as dependências:
   ```bash
   composer install
   ```

3. Gere a chave da aplicação:
   ```bash
   php artisan key:generate
   ```

4. Crie o arquivo de banco de dados SQLite:
   ```bash
   touch database/database.sqlite
   ```

5. Edite o arquivo `.env` com as seguintes variáveis:
   ```env
   DB_CONNECTION=sqlite
   DB_DATABASE=/caminho/completo/até/database/database.sqlite

   QUEUE_CONNECTION=database

   MAIL_MAILER=smtp
   MAIL_HOST=sandbox.smtp.mailtrap.io
   MAIL_PORT=2525
   MAIL_USERNAME=seu_username
   MAIL_PASSWORD=sua_senha
   MAIL_ENCRYPTION=tls
   MAIL_FROM_ADDRESS=test@bolos.com
   MAIL_FROM_NAME="Bolos da Dona Flor"
   ```

6. Gere a tabela de jobs para fila:
   ```bash
   php artisan queue:table
   ```

7. Execute as migrations:
   ```bash
   php artisan migrate
   ```

8. Inicie o servidor:
   ```bash
   php artisan serve
   ```

9. Inicie o worker da fila (em outro terminal):
   ```bash
   php artisan queue:work
   ```

---

## 📘 Documentação da API

A documentação está no formato OpenAPI (Swagger):

- O arquivo `cakes-api-doc.json` está localizado na raiz do projeto.
- Para visualizar:
    1. Acesse [https://editor.swagger.io](https://editor.swagger.io)
    2. Clique em **File > Import file**
    3. Selecione o arquivo `cakes-api-doc.json`

Você verá uma documentação interativa da API com todos os endpoints.

---

## ✅ Pronto! Agora você pode cadastrar bolos e o sistema notificará automaticamente os interessados via e-mail. 🍰📬
