# facturacion-test-backend

## How to deploy

### 1) First config .env file

```
DB_HOST=
DB_DATABASE=
DB_USERNAME=
DB_PASSWORD=
```

### 2) Run migrations

```
php artisan migrate
```

### 3) Run server

```
php -S localhost:8000 -t public/
```
