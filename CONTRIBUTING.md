# Contributing

## Preparing for development

If you have ever worked on a Laravel application, it's the same :

* Fork this repository, then clone it to your device
* Install PHP dependencies with `composer install`
* Install JS dependencies with :
  * NPM : `npm install`
  * Yarn : `yarn`
* Copy `.env.exemple` to `.env` and change DB fields to your local configuration
* Run `php artisan serve` to launch the built in Laravel server
* Run `npm run watch` or `yarn watch` to watch for CSS and JS files to be compiled
* Access the application at ![localhost:8000](http://localhost:800)

## Testing

After each modifications, make sure to run tests. The tests are located in `/tests/Feature`.
To run the tests, type `php artisan test`.
