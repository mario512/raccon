# Raccon

Raccon is a small PHP framework for quickly starting a simple project and learning how web applications work. It keeps the entry threshold low: routes, controllers, models, templates, sessions, database access, image helpers, and language files are plain PHP files that can be opened and understood without a large toolchain.

The repository includes a small demo application. Treat it as educational code and a starting point, not as a finished production product.

## Requirements

- PHP 8.0 or newer
- PDO MySQL extension
- MySQL or MariaDB
- Apache with `mod_rewrite`, or another web server configured to route requests to `index.php`

## Quick Start

```bash
cp .env.example .env
```

Set your database credentials in `.env`, import your schema, and point the web server document root to your project directory:

```text
/path/to/your/raccon
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

See [docs/structure.md](docs/structure.md) for a simple guide to the project layout and request flow.

## Configuration

Public defaults live in `Config/Config.php`. Private values should be provided through environment variables or a local `.env` file and must not be committed.

Important variables:

- `APP_DEBUG=0` for production
- `APP_TIMEZONE=UTC`
- `APP_LANGUAGE=en` for English interface strings
- `DB_HOST=localhost`
- `DB_DATABASE=raccon`
- `DB_USERNAME=raccon`
- `DB_PASSWORD=`

Language files live in `Views/Catalog/<theme>/locale/<language>/` for the public site and `Views/Admin/locale/<language>/` for the admin area. The legacy Russian admin files in `Views/Admin/Language/ru/` are still supported.

## Publication Notes

- Keep `.env`, logs, SQL dumps, archives, IDE settings, and generated cache out of git.
- Do not publish real credentials, user records, or private contact details.
- Use HTTPS in production.
- Review authentication, authorization, CSRF protection, validation, file uploads, and error handling before using this code beyond learning or prototyping.

## License

MIT
