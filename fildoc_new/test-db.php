<?php

use Illuminate\Support\Facades\DB;

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

try {
    DB::connection()->getPdo();
    echo "✅ Connexion à la base PostgreSQL réussie.\n";
    echo "Base utilisée : " . DB::connection()->getDatabaseName() . "\n";
} catch (\Exception $e) {
    echo "❌ Échec de la connexion à la base PostgreSQL.\n";
    echo "Erreur : " . $e->getMessage() . "\n";
}