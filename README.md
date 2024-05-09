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

DB_TEST_HOST="market_db"
DB_TEST_PORT="5432"
DB_TEST_USERNAME="postgres"
DB_TEST_PASSWORD="123456"
DB_TEST_NAME="market_test"

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

O sistema consiste em duas aplicações, o frontend `/web` e o backend `/server`, rodando um dos dois comando acima irá 
inicializar ambas as aplicações e o banco de dados.


#### CORS:

Para rodar o sistema utilizando docker no `localhost` é necessário utilizar um desabilitador de cors, para testar em 
minha máquina utilizei a extensão a [CORS - Unblock](https://chromewebstore.google.com/detail/lfhmikememgdcahcdlaciloancbhjino).