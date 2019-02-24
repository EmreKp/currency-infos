# currency-infos
A Symfony web project for fetching currencies and choosing cheapest one. Database is created with SQLite.
 You can define more APIs with adapter pattern.

## How to run?

```
composer install

php bin/console server:run
```

You can access to URL on http://127.0.0.1:8000/ .

If you want to change DB system of app, you should specify your db url in .env file and then migrate by running

```
php bin/console doctrine:migrations:migrate
```

## Updating currencies

If you want to update currencies, you should run

```
php bin/console app:update
```

## Running tests

```
php bin/phpunit
```