AbbysFramework
==============

Welcome to Abbys Framework website, this is not another PHP framework for agile web development, this is a good place to start coding your first web site. With Abby's framework you will be using our best, that is web objects, something that you are willing to find in other frameworks but you're still looking for. This is the right place, Abby's framework, as solid as rock!. 

## Quick start

```
docker compose up --build
```

Then open http://localhost:8080 and log in with:

- **User:** `admin`
- **Password:** `admin123`

(Change or remove that seed account before putting this anywhere public — see `abbys.sql`.)

This spins up the app on PHP 8.2 + Apache and a PostgreSQL database seeded from `abbys.sql`
(the `grupo`/`usuario` tables plus that one admin account). Data persists in a Docker volume
across restarts; run `docker compose down -v` to wipe it and start fresh.

## Tests

```
composer install
composer test
```

The suite covers the framework core (routing, validation, models, sessions, HTTP handling)
with plain PHPUnit tests — no database required. See `TEST_COVERAGE_ANALYSIS.md` for the
original coverage audit.

## Known limitations

This is a 2012-era learning framework modernized to run on PHP 8, not a hardened one:

- `Model::prepareStatement()` builds queries by string substitution (escaped with
  `addslashes()`), not real parameterized queries/PDO bindings.
- Only the `usuario` (login/CRUD) module ships as a working example; it's a good reference
  for building your own modules on top of `Application`/`Model`/`Router`.
