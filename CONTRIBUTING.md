# Contributing

Thanks for taking a look at Abby's Framework! This started as a 2012 learning
project and has since been modernized to run on PHP 8, so contributions that
keep it simple and readable are especially welcome.

## Getting set up

```
git clone https://github.com/bizoru/AbbysFramework.git
cd AbbysFramework
docker compose up --build
```

See the [README](README.md) for the default login and more details.

## Running tests

```
composer install
composer test
```

Please add or update tests for any behavior change — see
`TEST_COVERAGE_ANALYSIS.md` for the areas that still need coverage.

## Submitting changes

1. Fork the repo and create a branch off `master`.
2. Make your change, with tests passing (`composer test`).
3. Open a pull request describing what changed and why.

## Reporting bugs

Open an issue with steps to reproduce, what you expected, and what happened
instead. Since this is a small side project, response times may vary.
