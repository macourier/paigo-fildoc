# Paigo / Fildoc – RH & Paie (Laravel + Filament)

## Stack
- Laravel 10, PHP 8.4
- Filament v3 (admin `/admin`)
- PostgreSQL 17
- Vite + Tailwind

## Installation (dev)
```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php -S 127.0.0.1:10000 -t public
```

## Panel admin
- URL: /admin

**Ne pas committer**: `.env`, `vendor/`, `node_modules/`
