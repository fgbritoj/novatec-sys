# NovaTec - Sistema de Gestão para Assistência Técnica

Sistema web para gestão de assistência técnica em informática, desenvolvido com Laravel e Vue.js.

## 🚀 Requisitos

- PHP 8.1 ou superior
- Composer
- Node.js 16 ou superior
- MySQL 8.0 ou superior
- Redis (para sessões e cache)

## 📦 Instalação

1. Clone o repositório:
```bash
git clone https://github.com/seu-usuario/novatec.git
cd novatec
```

2. Instale as dependências do PHP:
```bash
composer install
```

3. Instale as dependências do Node.js:
```bash
npm install
```

4. Configure o ambiente:
```bash
cp .env.example .env
php artisan key:generate
```

5. Configure o banco de dados no arquivo `.env`:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=novatec
DB_USERNAME=seu_usuario
DB_PASSWORD=sua_senha
```

6. Configure o Redis no arquivo `.env`:
```
REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379
```

7. Execute as migrações:
```bash
php artisan migrate
```

8. Compile os assets:
```bash
npm run build
```

## 🚀 Deploy em Produção

### Requisitos do Servidor

- Nginx ou Apache
- PHP 8.1+
- MySQL 8.0+
- Redis
- Certificado SSL (recomendado)

### Configuração do Nginx

```nginx
server {
    listen 80;
    server_name seu-dominio.com;
    root /var/www/novatec/public;

    add_header X-Frame-Options "SAMEORIGIN";
    add_header X-Content-Type-Options "nosniff";

    index index.php;

    charset utf-8;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location = /favicon.ico { access_log off; log_not_found off; }
    location = /robots.txt  { access_log off; log_not_found off; }

    error_page 404 /index.php;

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.1-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }

    location ~ /\.(?!well-known).* {
        deny all;
    }
}
```

### Passos para Deploy

1. Configure o servidor web
2. Clone o repositório
3. Configure o ambiente de produção
4. Instale dependências
5. Execute migrações
6. Configure o supervisor para filas
7. Configure o agendador de tarefas (cron)

## 🔒 Segurança

- Todas as senhas são armazenadas com hash bcrypt
- Proteção CSRF ativada
- Sessões armazenadas no Redis
- Headers de segurança configurados
- Rate limiting para APIs

## 📝 Licença

Este projeto está sob a licença MIT. Veja o arquivo [LICENSE](LICENSE) para mais detalhes.

## 🤝 Suporte

Para suporte, envie um email para suporte@novatec.com
