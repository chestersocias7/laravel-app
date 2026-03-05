<?php
require __DIR__.'/ireply/vendor/autoload.php';
$app = require_once __DIR__.'/ireply/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$user = \App\Models\User::where('email', 'admin@ireply.com')->first();
if ($user) {
    echo "User found: " . $user->email . " (Role: " . $user->role . ")\n";
} else {
    echo "User not found.\n";
    $newUser = \App\Models\User::create([
        'name' => 'Admin',
        'email' => 'admin@ireply.com',
        'password' => \Illuminate\Support\Facades\Hash::make('password123'),
        'role' => 'admin',
    ]);
    echo "Created user: " . $newUser->email . "\n";
}
