<p align="center"><img src="https://i.imgur.com/4TU5pl8.png" width="200"></p>

<p align="center"></p>

# ShineBoard
## A Beautiful way to share code

<img src="https://i.imgur.com/E8wVJoW.png"></p>

ShineBoard is a open-source platform to make sharing code easier. Wasted by all the .txt files you downloaded and the poor hastebin codes ? Switch now to ShineBoard :
* Open [shineboard.io](https://shineboard.io)
* Paste your file's content
* Hit CTRL + S to save the paste, and then CTRL + V to share the link

Alternatively, you can use the [CLI](https://github.com/ShineBoard/cli) to create paste from your terminal.

## Contributing

If you have ever worked on a Laravel application, it's the same :
* Fork this repository, then clone it to your device
* Install PHP dependencies with `composer install`
* Install JS dependencies with :
  * NPM : `npm install`
  * Yarn : `yarn`
* Copy `.env.exemple` to `.env` and change DB fields to your local configuration
* Run `php artisan serve` to launch the built in Laravel server
* Run `npm run watch` or `yarn watch` to watch for CSS and JS files to be compiled
* Access the application at [localhost:8000](http://localhost:8000)

To make sure nothing is broken after your modifications, run `php artisan test`.

## License

ShineBoard is licensed under the [Apache license](http://www.apache.org/licenses/LICENSE-2.0).
