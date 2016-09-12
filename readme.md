# laravel-crud-elasticsearch
A simple CRUD operation on a Laravel Model with Elasticsearch index and retrive

### Setup project settings

Use `--recursive` option during cloning this repo

```
cd ~/project-dir

composer install

cp .env.example .env

php artisan key:generate
```

```
cd ~/project-dir/laradock

docker-compose up -d nginx mysql elasticsearch

docker-compose exec workspace bash

php artisan migrate --seed
```
