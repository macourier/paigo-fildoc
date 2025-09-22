<?php
// Script de diagnostic : liste les panels Filament et leurs propriétés principales.
// Exécuter depuis c:\FildocDev\sites\fildoc avec:
// cd ..\fildoc_new && php scripts/inspect_filament.php

require __DIR__ . '/../vendor/autoload.php';

$app = require __DIR__ . '/../bootstrap/app.php';

// Bootstrap minimal pour utiliser le container & facades
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "APP_ENV: " . env('APP_ENV') . PHP_EOL;
echo "FILAMENT CONFIG EXISTS: " . (file_exists(__DIR__ . '/../config/filament.php') ? 'yes' : 'no') . PHP_EOL;

try {
    $panels = Filament\Facades\Filament::getPanels();

    echo "PANELS COUNT: " . count($panels) . PHP_EOL;

    foreach ($panels as $panel) {
        echo "----" . PHP_EOL;
        echo "ID: " . $panel->getId() . PHP_EOL;
        echo "Path: " . $panel->getPath() . PHP_EOL;
        echo "Domain: " . ($panel->getDomain() ?? '(none)') . PHP_EOL;
        echo "Has Login: " . ($panel->hasLogin() ? 'yes' : 'no') . PHP_EOL;
        echo "Has Registration: " . ($panel->hasRegistration() ? 'yes' : 'no') . PHP_EOL;
        echo "Has Profile: " . ($panel->hasProfile() ? 'yes' : 'no') . PHP_EOL;
        echo "Middleware: " . json_encode($panel->getMiddleware()) . PHP_EOL;
        echo "Auth Middleware: " . json_encode($panel->getAuthMiddleware()) . PHP_EOL;
    }
} catch (Throwable $e) {
    echo "ERROR: " . get_class($e) . ": " . $e->getMessage() . PHP_EOL;
    echo $e->getTraceAsString() . PHP_EOL;
}
