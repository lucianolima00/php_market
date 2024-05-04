PHP Market
-------------------

Este software foi desenvolvido por Luciano Lima para um desafio pratico de programção web.

REQUISITOS
------------

Para a utilização é necessário uma máquina com o [DOCKER](https://www.docker.com/) instalado.

CONFIGURAÇÃO
-------------

Para utilizar em ambiente de desenvolvimento copie e cole o arquivo [.env-example](./.env-example) renomeando para `.env`  completando as informações, como no exemplo:

```dotenv
DB_HOST="localhost"
DB_PORT="5432"
DB_USERNAME="postgres"
DB_PASSWORD="123456"
DB_NAME="market"

APP_PORT="8888"
```

#### OBSERVAÇÕES:

Após criar o arquivo `.env`, no seu ambiente de desenvolvimento execute os comandos:

```shell
docker compose up -d
```

ou, caso o container já esteja rodando, execute:

```shell
docker compose up -d --build --force-recreate
```
