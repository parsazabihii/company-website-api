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
- Role and permission management endpoints
- CRUD APIs for services, service features, projects, project images, products, categories, news, menus, sliders, events, licenses, sub-brands, team members and FAQs
- Contact-message management
- Client reviews and replies
- About-us and site-setting management
- Admin-log listing and detail endpoints
- Request validation, API resources and service-layer separation
- OpenAPI documentation classes and Bruno collection

## Local setup
```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan db:seed
npm install
npm run build
php artisan serve
```

In Git Bash, use `cp` as shown. In Windows Command Prompt, use `copy`; in PowerShell, use `Copy-Item`. Before migrating, configure the database settings in `.env` and create the database if required. The commands above are for a local development environment.

## API documentation
Generate Swagger documentation with:
```bash
php artisan l5-swagger:generate
```
Then open the Swagger UI route configured by L5-Swagger (commonly `/api/documentation`).

## Local test account

After configuring your local database and running `php artisan db:seed`, the seeder creates the roles, permissions and an active admin account:

- Email: `admin@example.com`
- Password: `password`

These credentials are for local development only, not an online demo. The user seeder uses `updateOrCreate`, so running it again resets this account's password and profile fields. Do not run it against a production database.

## Authentication
Admin routes are protected with Laravel Sanctum. Start with:
```text
POST /api/admin/auth/login
GET  /api/admin/auth/me
POST /api/admin/auth/logout
```

## Testing

The current repository contains the default Laravel example tests. Dedicated tests for authentication, permissions and content-management flows have not been added yet. Passing the example tests does not establish that the API workflows work correctly.

```bash
php artisan test
```

## Repository hygiene
Do not commit `.env`, `vendor/`, `node_modules/`, IDE metadata, local SQLite databases, or generated runtime files. Use `.env.example` as the configuration template.
