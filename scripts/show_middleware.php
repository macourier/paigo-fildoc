<?php
require __DIR__ . '/../vendor/autoload.php';

$app = require __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\Route;

$route = Route::getRoutes()->getByName('filament.admin.auth.login');

if (! $route) {
    echo "Route not found\n";
    exit(1);
}

echo "Route name: " . $route->getName() . PHP_EOL;
echo "URI: " . $route->uri() . PHP_EOL;
echo "Middleware: " . PHP_EOL;
print_r($route->gatherMiddleware());
