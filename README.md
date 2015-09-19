# Ronin Blade

[![Build Status](https://travis-ci.org/atijust/ronin-blade.svg)](https://travis-ci.org/atijust/ronin-blade)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/atijust/ronin-blade/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/atijust/ronin-blade/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/atijust/ronin-blade/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/atijust/ronin-blade/?branch=master)
[![License](https://poser.pugx.org/atijust/ronin-blade/license)](https://packagist.org/packages/atijust/ronin-blade)

Laravel Blade template engine as a standalone component.

```php
<?php
require_once __DIR__ . '/vendor/autoload.php';

$blade = Ronin\Blade::make(__DIR__ . '/views', __DIR__ . '/cache');
echo $blade->make('index', ['message' => 'Hello, world!'])->render();
```

## Installation

Require this package in your composer.json and run composer update command.

```json
{
    "require": {
        "atijust/ronin-blade": "dev-master@dev"
    }
}
```

## Usage

`\Ronin\Blade::make()` returns a instance of `Illuminate\View\Factory`.

```php
$blade = Ronin\Blade::make(__DIR__ . '/views', __DIR__ . '/cache');
echo get_class($blade); // => Illuminate\View\Factory
```

You can use all blade features.

```php
// Add a piece of shared data to the environment.
$blade->share('defaultTitle', 'Ronin Blade');

// Register a view composer event.
$blade->composer('index', 'IndexViewComposer');

// Register a handler for custom directives.
$blade->getEngineResolver()->resolve('blade')->getCompiler()->directive(
    'datetime',
    function($expression) {
        return "<?php echo with{$expression}->format('m/d/Y H:i'); ?>";
    }
);

// Get the evaluated view contents for the given view.
$view = $blade->make('index');
```

By default, view composer and view creater are resolved by the ronin's internal container. If you want to use your own container, set the third parameter of `\Ronin\Blade::make()` to any container you like.

```php
$container = new \Illuminate\Container\Container();
$container->singleton('IndexViewComposer', function () {
    return new IndexViewComposer();
});

$blade = \Ronin\Blade::make(__DIR__ . '/views', __DIR__ . '/cache', $container);
$blade->composer('index', 'IndexViewComposer'); // Resolved by $container
```

## License
Ronin Blade is open-sourced software licensed under the MIT license.