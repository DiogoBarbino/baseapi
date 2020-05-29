## Base API

Projeto inicial de uma API genérica.
Esta API é um bom ponto de partida para criação de APIs com Laravel

Descrição do Sistema
- Sistema de Admin com AdminLTE 3. [AdminLTE](https://github.com/jeroennoten/Laravel-AdminLTE).
- Controle de permissão com ACL. [Spartie](https://docs.spatie.be/laravel-permission/v3/introduction/).
- Controle de acesso com JWT. [JWT Auth](https://jwt-auth.readthedocs.io/en/develop/).

Espero que seja util!!!

## Instrução

-Abra seu terminal favorito e escolha a pasta onde quer instalar o projeto. 
-Clone o repositório

```git clone https://github.com/DiogoBarbino/baseapi.git```

-Renomei o arquivo `.env.example` para apenas `.env` e coloque as suas configurações.

-Instale as dependências com os comandos:

```Composer install```
```npm install```
```npm run dev```

-Gere a chave do aplicavo com o comando ```php artisan key:generate```

-Nesta etapa é necessário que o banco SQL já esteja ativo e corretamente configurado

-Execute as migrações do banco de dados ```php artisan migrate```

-Execute o projeto ```php artisan serve```

-Agora você pode entrar no sistema pelo http://localhost:8000


...Continua
