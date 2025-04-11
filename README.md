# 🍰 CAKES API

Este é um projeto de uma **API REST** para o cadastro de bolos.  
A cada novo bolo cadastrado, o sistema armazena informações como: nome, valor, peso (em gramas), quantidade disponível e uma lista de e-mails de clientes interessados.<br>
Se o bolo estiver disponível, o sistema **envia e-mails automaticamente** para os interessados utilizando **filas (queues)** do Laravel.

Para garantir que o sistema seja escalável mesmo com milhares de e-mails (ex: 50.000 ou mais), foi adotado o uso do **Redis** como gerenciador de filas, além de técnicas como **chunking** (divisão em blocos) e **atraso inteligente** dos jobs.

---

## ⚠️ Pré-requisitos

- PHP 8.2+
- Composer
- Redis instalado localmente ([guia oficial de instalação](https://redis.io/docs/getting-started/installation/))
- Conta gratuita no [Mailtrap](https://mailtrap.io/) para testar envio de e-mails

---

## 🚀 Instruções de instalação

1. Clone este repositório:
   ```bash
   git clone https://github.com/lilicunhadev/cakes-api.git
   cd cakes-api
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

   QUEUE_CONNECTION=redis
   CACHE_DRIVER=redis
   SESSION_DRIVER=redis

   # Usando Mailtrap
   MAIL_MAILER=smtp
   MAIL_HOST=sandbox.smtp.mailtrap.io
   MAIL_PORT=2525
   MAIL_USERNAME=seu_username
   MAIL_PASSWORD=sua_senha
   MAIL_ENCRYPTION=tls
   MAIL_FROM_ADDRESS=test@bolos.com
   MAIL_FROM_NAME="Bolos da Dona Flor"

   REDIS_CLIENT=phpredis
   REDIS_HOST=127.0.0.1
   REDIS_PORT=6379
   REDIS_PASSWORD=null
   ```

6. Execute as migrations:
   ```bash
   php artisan migrate
   ```

7. Inicie o servidor Laravel:
   ```bash
   php artisan serve
   ```

8. Em outro terminal, inicie o worker da fila:
   ```bash
   php artisan queue:work --tries=3 --timeout=60 --backoff=10
   ```

---

## 🧪 Como testar a API

É recomendado o uso de ferramentas como [Postman](https://www.postman.com/) ou [Insomnia](https://insomnia.rest/) para testar os endpoints da API com facilidade.

Exemplo de requisição para criação de bolo (POST `/api/bolos`):

```json
{
  "nome": "Bolo de Chocolate",
  "peso": 1000,
  "valor": 42.50,
  "quantidade_disponivel": 10,
  "emails_interessados": [
    "cliente1@email.com",
    "cliente2@email.com"
  ]
}
```
---
## 🧪 Testes com PestPHP

O projeto utiliza o [PestPHP](https://pestphp.com/) como framework de testes, oferecendo uma sintaxe fluida e moderna para testes unitários, de validação e de funcionalidades da API.

### Instalação do Pest

Se ainda não estiver instalado, execute os comandos abaixo para instalar o Pest no projeto:

```bash
composer require pestphp/pest:^3.8 nunomaduro/collision:^8.8 phpunit/phpunit:^11.5 --dev --with-all-dependencies
composer require pestphp/pest-plugin-laravel --dev
vendor/bin/pest --init
```

### Rodando os testes

Para executar todos os testes do projeto:

```bash
vendor/bin/pest
```

Durante a execução, o Pest mostra um resumo com os testes que passaram ou falharam.

---

## 🛠️ Monitoramento dos e-mails enviados

O processo de envio de e-mails ocorre de forma assíncrona por meio de **jobs** enfileirados no Redis.

Para acompanhar o que está acontecendo, você pode visualizar os logs no Laravel:

```bash
tail -f storage/logs/laravel.log
```

Ali você verá mensagens como:

```
[INFO] Iniciando envio do bolo 'Bolo de Chocolate' para 1000 interessados...
[INFO] E-mail enviado para: cliente1@email.com
[ERROR] Falha ao enviar para cliente2@email.com: SMTP server not responding
[INFO] Job finalizado para 1000 e-mails (Bolo: Bolo de Chocolate)
```

Esses logs ajudam a verificar se o envio está funcionando corretamente ou se houve algum erro com algum destinatário.

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

### ✅ Agora você pode cadastrar bolos e o sistema notificará automaticamente os interessados via e-mail, com escalabilidade garantida. 🍰⚡
