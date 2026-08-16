# Raccon

Raccon is a small PHP framework for quickly starting a simple project and learning how web applications work. It keeps the entry threshold low: routes, controllers, models, templates, sessions, database access, image helpers, and language files are plain PHP files that can be opened and understood without a large toolchain.

The repository includes a demo application. Treat it as educational code and a starting point, not as a finished commercial or financial product.

## Requirements

- PHP 8.0 or newer
- PDO MySQL extension
- MySQL or MariaDB
- Apache with `mod_rewrite`, or another web server configured to route requests to `index.php`

## Quick Start

```bash
cp .env.example .env
```

Set your database credentials in `.env`, import your schema, and point the web server document root to this directory:

```text
/var/www/light-cart.com/raccon
```

For local PHP testing you can run:

```bash
php -S 127.0.0.1:8000 index.php
```

## Project Structure

```text
Components/   core classes: router, loader, database, templates, sessions
Config/       application settings, routes, menu and language config
Controllers/  request handlers
Models/       database-facing application logic
Views/        catalog and admin templates
image/        source images committed to the project
cache/        generated runtime files, ignored by git
index.php     public entry point
```

## Configuration

Public defaults live in `Config/Config.php`. Private values should be provided through environment variables or a local `.env` file and must not be committed.

Important variables:

- `APP_DEBUG=0` for production
- `APP_TIMEZONE=UTC`
- `DB_HOST=localhost`
- `DB_DATABASE=raccon`
- `DB_USERNAME=raccon`
- `DB_PASSWORD=`

## Publication Notes

- Keep `.env`, logs, SQL dumps, archives, IDE settings, and generated cache out of git.
- Do not publish real credentials, user records, order data, or private contact details.
- Use HTTPS in production.
- Review authentication, authorization, CSRF protection, validation, file uploads, and error handling before using this code beyond learning or prototyping.

## License

MIT
