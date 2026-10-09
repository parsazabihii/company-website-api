# Company Website API

Backend API for a company website and admin panel, built with Laravel 13. It provides authentication, role/permission management, content management, contact messages, projects, products, services, news, reviews, site settings, and OpenAPI documentation.

## Tech stack
- PHP 8.3+
- Laravel 13
- Laravel Sanctum
- SQLite by default (can be switched to MySQL/PostgreSQL)
- L5-Swagger / OpenAPI
- Vite + Tailwind CSS

## Main features
- Admin authentication with access and refresh flows
- Role and permission management
- CRUD APIs for services, service features, projects, project images, products, categories, news, menus, sliders, events, licenses, sub-brands, team members and FAQs
- Contact-message management
- Client reviews and replies
- About-us and site-setting management
- Admin activity logs
- Request validation, API resources and service-layer separation
- OpenAPI documentation classes and Bruno collection

## Local setup
```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
npm install
npm run build
php artisan serve
```

On Windows, replace `cp` with `copy`.

## API documentation
Generate Swagger documentation with:
```bash
php artisan l5-swagger:generate
```
Then open the Swagger UI route configured by L5-Swagger (commonly `/api/documentation`).

## Authentication
Admin routes are protected with Laravel Sanctum. Start with:
```text
POST /api/admin/auth/login
GET  /api/admin/auth/me
POST /api/admin/auth/logout
```

## Testing
```bash
php artisan test
```

## Repository hygiene
Do not commit `.env`, `vendor/`, `node_modules/`, IDE metadata, local SQLite databases, or generated runtime files. Use `.env.example` as the configuration template.
