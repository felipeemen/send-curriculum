# Formulário para envio de currículos

### Laravel 12 + Shadcn + Vue + Inertia.js + MySQL

### Nome, e-mail, telefone, Cargo Desejado (Campo texto livre), Escolaridade (Campo select), observações, arquivo e data e hora do envio.
### Filas e Jobs para o envio do email com os dados do formulario

## Instalação

### Clonar o repositório
```
https://github.com/felipeemen/send-curriculum
```
### Instalar com Docker
```
docker compose up
```

### Remover aplicação
```
docker compose down
```

### Criar novo arquivo .env:
```
cp .env.example .env
```

### Gerar a chave da aplicação
```
php artisan key:generate
```

### Configurar banco de dados
Edite o arquivo ```.env``` com as credenciais do banco de dados e Email.

### Configuração de email, defina o ```MAIL_USERNAME``` e ```MAIL_PASSWORD```:

```
#Mailtrap
 MAIL_MAILER=smtp
 MAIL_HOST=sandbox.smtp.mailtrap.io
 MAIL_PORT=2525
 MAIL_USERNAME=
 MAIL_PASSWORD=
 MAIL_ENCRYPTION=tls
 MAIL_FROM_ADDRESS=no-reply@meusistema.com
 MAIL_FROM_NAME="${APP_NAME}"
```

### Se necessário

Instalar dependências do Laravel

```
docker exec -it app-curriculum bash
composer install
```

### Rodar migrations

```
docker exec -it app-curriculum php artisan migrate
```

## Exemplo Testes utilizando Pest

```
describe('Página de envio de currículo', function () {
    it('pode ser acessada', function () {
        $response = get('/');

        $response->assertStatus(200);
    });
});
```

### Imagem:

![Captura de tela 2025-10-02 172915](https://github.com/user-attachments/assets/6ab2183c-4317-4e17-86f3-e4920e3c9272)

