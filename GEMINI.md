# Project Overview: Stocker

@./GEMINI.laravel.md

## Tech Stack

- **Framework:** Laravel 13 (PHP 8.5)
- **Frontend:** Livewire 4, Flux UI, Tailwind CSS 4 (Vite)
- **Authentication:** Laravel Fortify (Backend-agnostic Auth), Laravel Sanctum (API Tokens)
- **Database:** SQLite (Default), Redis (Predis for caching/queues)
- **Infrastructure:** Docker (PHP 8.5 + Apache), Traefik for local development proxy
- **Testing:** Pest 4, PHPUnit 12
- **Code Quality:** Rector 2, PHPStan (Larastan 3), Laravel Pint 1

## Building and Running

### Prerequisites
- PHP 8.5+
- Composer
- Node.js & NPM
- Docker (optional, for containerized development)

### Key Commands

- **Setup Project:**
  ```bash
  composer setup
  ```
  (Installs dependencies, sets up `.env`, generates key, runs migrations, and builds frontend assets)

- **Development Server:**
  ```bash
  composer dev
  ```
  (Runs `php artisan serve`, `queue:listen`, `pail`, and `npm run dev` concurrently)

- **Testing:**
  ```bash
  composer test          # Runs all tests and static analysis
  composer test:unit     # Runs unit tests only
  composer test:feature  # Runs feature tests only
  ```

- **Static Analysis & Linting:**
  ```bash
  composer lint          # Checks code quality (Rector, PHPStan, Pint)
  composer lint:fix      # Automatically fixes code quality issues
  ```

- **Frontend Assets:**
  ```bash
  npm run dev            # Start Vite development server
  npm run build          # Build assets for production
  ```

## Development Conventions

### Laravel Boost Integration
This project uses **Laravel Boost**, an MCP server. Always prefer Boost tools over manual alternatives:
- Use `database-schema` to inspect tables before creating models or migrations.
- Use `search-docs` to find up-to-date documentation for the Laravel ecosystem.
- Use `browser-logs` to debug frontend issues.

### Coding Style
- **PHP:** Strict typing (`declare(strict_types=1);`), constructor property promotion, and explicit return types. Follow [Laravel Pint](https://laravel.com/docs/pint) rules.
- **Components:** Prefer [Flux UI](https://fluxui.dev/) components for the UI. Check `resources/views/components` for reusable elements.
- **Naming:** Use descriptive, camelCase for variables/methods and PascalCase for Classes/Enums.

### Testing
- **Pest:** Use Pest for all new tests. Feature tests are preferred over Unit tests for most logic.
- **Database:** Use migrations for schema changes and Factories/Seeders for data generation.

### Verification
- Always run `composer quality` before finalizing changes to ensure code style, static analysis, and tests pass.

## Key Files & Directories
- `app/Models/`: Contains `Stock.php` and `Transaction.php`.
- `app/Actions/Fortify/`: Authentication logic (Registration, Password Resets).
- `resources/views/pages/`: Page-specific views.
- `routes/web.php` & `routes/settings.php`: Main application routing.
- `GEMINI.laravel.md`: Contains detailed Laravel Boost guidelines and domain-specific skill activations.
