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
