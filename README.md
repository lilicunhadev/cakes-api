# 🍰 CAKES API

Este é um projeto de uma **API RESTful** desenvolvida em Laravel para gerenciamento de bolos.  
> Cada vez que um novo bolo é cadastrado, o sistema armazena informações como: nome, valor, peso (em gramas), quantidade disponível e uma lista de e-mails de clientes interessados.  
> Se o bolo tiver unidades disponíveis, o sistema **envia e-mails automaticamente** aos interessados utilizando **filas (queues)** com **Redis** como driver de backend, além de técnicas de **chunking** e **atraso inteligente** nos jobs para garantir escalabilidade mesmo com dezenas de milhares de destinatários.  
> A persistência dos dados é feita em um banco **SQLite**, ideal para ambientes de desenvolvimento e testes rápidos.  
> Além disso, o sistema conta com **testes automatizados usando PestPHP**, e uma documentação completa no padrão **OpenAPI/Swagger**.
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

7. (Opcional) Popule o banco de dados com bolos fictícios:
   ```bash
   php artisan db:seed
   ```

8. Inicie o servidor Laravel:
   ```bash
   php artisan serve
   ```

9. Em outro terminal, inicie o worker da fila:
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

## 🌱 Seeds

O projeto inclui um seeder chamado `BoloSeeder`, que preenche o banco de dados com bolos fictícios para testes e demonstrações.  
Para executá-lo manualmente:

```bash
php artisan db:seed
```

Esse comando insere bolos com diferentes valores e quantidades, incluindo e-mails de interessados. Ideal para testar o envio automático de e-mails e a visualização de dados na API.

Além disso, o seeder também utiliza a biblioteca `Faker` para gerar bolos aleatórios com nomes, valores, pesos e e-mails variados. Isso garante diversidade nos dados e facilita testes realistas durante o desenvolvimento.

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
