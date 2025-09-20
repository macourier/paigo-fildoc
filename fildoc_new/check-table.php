<?php

use Illuminate\Support\Facades\DB;

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

try {
    $tables = DB::select("SELECT tablename FROM pg_tables WHERE schemaname = 'public'");
    
    echo "📦 Tables présentes dans la base '" . DB::connection()->getDatabaseName() . "' :\n";
    foreach ($tables as $table) {
        echo "- " . $table->tablename . "\n";
    }
} catch (\Exception $e) {
    echo "❌ Erreur lors de la récupération des tables : " . $e->getMessage() . "\n";
}