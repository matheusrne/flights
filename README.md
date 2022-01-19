### Passo a passo
Clone Repositório
```sh
git clone https://github.com/matheusrne/flights.git flights
```

Crie o Arquivo .env
```sh
cd flights/
cp .env.example .env
```

Suba os containers do projeto
```sh
docker-compose up -d
```

Acesse o swagger
[http://localhost:8180/api/documentation](http://localhost:8180/api/documentation)
