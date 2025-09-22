<?php
require __DIR__ . '/../vendor/autoload.php';

$app = require __DIR__ . '/../bootstrap/app.php';

/*
 * Bootstrap the application so facades and the container are available.
 */
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\User;
use Illuminate\Support\Facades\Hash;

/*
 * Create admin user
 */
$email = 'courieradrienmail@gmail.com';
$name = 'paigo';
$password = 'Open1986@';

// Check if user already exists
$existing = User::where('email', $email)->first();
if ($existing) {
    echo "EXISTS: user id {$existing->id}\n";
    exit(0);
}

$user = new User();
$user->name = $name;
$user->email = $email;
$user->password = Hash::make($password);
$user->save();

echo "CREATED: {$user->id}\n";
