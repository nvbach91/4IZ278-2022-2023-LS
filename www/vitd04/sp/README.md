# Kam za jídlem

Setup and run nextjs
```
cd apps/nextjs
cp .env.example .env
pnpm i
pnpm dev
```

Setup and run laravel
```
cd apps/laravel
cp .env.example .env
php composer.phar update
php artisan serve
```

update .env in laravel folder to match nextjs url