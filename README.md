### Passo a passo
Clone Repositório
```sh
git clone https://github.com/especializati/setup-docker-laravel.git my-project
cd my-project/
```

Crie o Arquivo .env
```sh
cd example-project/
cp .env.example .env
```

Suba os containers do projeto
```sh
docker-compose up -d
```


Acessar o container
```sh
docker-compose exec php bash
```


Instalar as dependências do projeto
```sh
composer install
```


Gerar a key do projeto Laravel
```sh
php artisan key:generate
```


Acesse a rota
[http://localhost:8180/api/flights](http://localhost:8180/api/flights)
