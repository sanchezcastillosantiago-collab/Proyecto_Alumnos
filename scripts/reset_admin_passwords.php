<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

$plain = 'contrasena';
$admins = DB::table('users')->where('role', 'admin')->get();
$result = [];
foreach ($admins as $a) {
    DB::table('users')->where('id', $a->id)->update([
        'password' => Hash::make($plain),
        'must_change_password' => 1,
    ]);
    $result[] = ['id' => $a->id, 'email' => $a->email];
}

echo json_encode(['updated' => $result, 'password_set_to' => $plain], JSON_PRETTY_PRINT);
