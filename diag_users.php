<?php
require __DIR__.'/ireply/vendor/autoload.php';
$app = require_once __DIR__.'/ireply/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$users = \App\Models\User::all();
echo "Total users found: " . count($users) . "\n";
foreach ($users as $u) {
    echo "ID: {$u->id} | Email: {$u->email} | Role: {$u->role} | Approved: " . ($u->is_approved ? 'Yes' : 'No') . "\n";
}
