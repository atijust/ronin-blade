# Ronin Blade

Laravel Blade template engine as a standalone component.

```php
<?php
require_once __DIR__ . '/vendor/autoload.php';

$blade = Ronin\Blade::make(__DIR__ . '/views', __DIR__ . '/cache');
echo $blade->make('index', ['message' => 'Hello, world!'])->render();
```
