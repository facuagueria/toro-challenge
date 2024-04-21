## Configuring the project
1. Clone repository
2. Install dependencies 

```bash
composer install
```
```bash
npm install
```

3. Create a copy of the .env file

```bash
cp .env.example .env
``` 

4. Generate an application key

```bash
php artisan key:generate
```
5. Create sqlite database

```bash
touch database/database.sqlite
```

6. Run migrations
    
```bash
php artisan migrate
```

## Running the project

1. Run server

```bash
php artisan serve
```

2. Run frontend

```bash
npm run dev
```
