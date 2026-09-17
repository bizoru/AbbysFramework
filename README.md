# 🧱 Abby's Framework

**A small PHP MVC framework from 2012, modernized to run cleanly on PHP 8.**

Front-controller routing, models, sessions and form validation — no framework
magic to fight, just the moving parts you'd build yourself. Not a
production-hardened toolkit (see [Known limitations](#known-limitations)).

[![license](https://img.shields.io/badge/license-MIT-2ea44f?style=flat&labelColor=24292e)](LICENSE)
[![php](https://img.shields.io/badge/php-%3E%3D8.2-8892BF?style=flat&labelColor=24292e)](composer.json)
[![database](https://img.shields.io/badge/database-PostgreSQL-336791?style=flat&labelColor=24292e)](abbys.sql)
[![deploy](https://img.shields.io/badge/deploy-Docker%20Compose-2496ED?style=flat&labelColor=24292e)](docker-compose.yml)

[![CI](https://github.com/bizoru/AbbysFramework/actions/workflows/ci.yml/badge.svg)](https://github.com/bizoru/AbbysFramework/actions/workflows/ci.yml)
[![codecov](https://codecov.io/gh/bizoru/AbbysFramework/graph/badge.svg)](https://codecov.io/gh/bizoru/AbbysFramework)

## Features

- Front-controller routing (`/application/controller/method/param`)
- A small `Model` base class with basic query building and validation hooks
- Session-based auth (`SessionMan`, `Application::checkAuth()`)
- A `Form`/`Validator` pair for per-field validation rules
- A working example module (`usuario`): login, list, create, edit, delete
- PostgreSQL support out of the box, with a Docker Compose setup for local dev

## Requirements

- PHP >= 8.2 with the `pgsql` and `pdo_pgsql` extensions
- PostgreSQL >= 13
- [Composer](https://getcomposer.org/) (for running the test suite)
- Docker + Docker Compose (optional, for the one-command quick start)

## Quick start (Docker)

```
docker compose up --build
```

Then open <http://localhost:8080> and log in with:

- **User:** `admin`
- **Password:** `admin123`

Change or remove that seed account before exposing this anywhere public — see
`abbys.sql`. This spins up the app on PHP 8.2 + Apache and a PostgreSQL
database seeded from `abbys.sql` (the `grupo`/`usuario` tables plus that one
admin account). Data persists in a Docker volume across restarts; run
`docker compose down -v` to wipe it and start fresh.

## Manual installation (without Docker)

1. Point an Apache vhost (with `mod_rewrite` and `AllowOverride All`) at the
   repository root, or run PHP's built-in server:
   ```
   php -S localhost:8080
   ```
2. Create a PostgreSQL database and load the schema:
   ```
   createdb abbys
   psql abbys < abbys.sql
   ```
3. Set connection details via environment variables (defaults shown):
   | Variable      | Default     |
   |---------------|-------------|
   | `DB_HOST`     | `localhost` |
   | `DB_USER`     | `postgres`  |
   | `DB_PASSWD`   | `postgres`  |
   | `DB_DATABASE` | `abbys`     |

   These are read in `system/config/settings.dev.php`.
4. Visit the site and log in with the seed admin account from `abbys.sql`
   (see [Quick start](#quick-start-docker) above).

## Project structure

```
application/<app>/<controller>/{controller,model,view}/   # your modules go here
system/                                                    # framework core
  routing/router.php       # URL -> application/controller/method/var
  db/model.php             # base Model class
  db/validator.php         # Form + Validator
  sessionman.php           # session helpers
  base.php                 # Application front controller
tests/                     # PHPUnit suite for the framework core
```

## Running tests

```
composer install
composer test
```

The suite covers the framework core (routing, validation, models, sessions,
HTTP handling) with plain PHPUnit tests — no database required. See
`TEST_COVERAGE_ANALYSIS.md` for the original coverage audit.

## Known limitations

This is a 2012-era learning framework modernized to run on PHP 8, not a
hardened one:

- `Model::prepareStatement()` builds queries by string substitution (escaped
  with `addslashes()`), not real parameterized queries/PDO bindings.
- Only the `usuario` (login/CRUD) module ships as a working example; it's a
  good reference for building your own modules on top of
  `Application`/`Model`/`Router`.

## Contributing

See [CONTRIBUTING.md](CONTRIBUTING.md).

## License

MIT — see [LICENSE](LICENSE).
