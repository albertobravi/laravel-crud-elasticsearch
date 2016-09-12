# laravel-crud-elasticsearch
A simple CRUD operation on a Laravel Model with Elasticsearch index and retrive

### Setup project settings

```
cd ~/project-dir

composer install
```

```
cd ~/project-dir/laradock

docker-compose up -d nginx mysql elasticsearch

docker-compose exec workspace bash

php artisan migrate --seed
```

# Enjoy