<?php
require __DIR__.'/bootstrap/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$email = 'rajsharma74411@outlook.com';
$user = DB::table('users')->where('email', $email)->first();

if ($user) {
    echo "User found:\n";
    echo "Email: " . $user->email . "\n";
    echo "Status ID: " . $user->userstatus_id . "\n";
    echo "Token: " . $user->token . "\n";
    echo "Role ID: " . $user->userrole_id . "\n";
} else {
    echo "User not found\n";
}
