<?php
require __DIR__.'/ireply/vendor/autoload.php';
$app = require_once __DIR__.'/ireply/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$user = \App\Models\User::where('email', 'admin@ireply.com')->first();
if ($user) {
    $user->is_approved = true;
    $user->save();
    echo "Admin account approved.\n";
} else {
    echo "Admin account not found.\n";
}
