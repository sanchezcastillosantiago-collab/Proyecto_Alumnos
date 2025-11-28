<?php
// Script to sanitize alumno.codigo values to digits only.
// Run: php scripts/sanitize_codigos.php

require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';

// Bootstrap the application (console kernel)
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Alumno;

$modified = 0;
$skipped = 0;

foreach (Alumno::all() as $alumno) {
    $old = (string) $alumno->codigo;
    $new = preg_replace('/\D+/', '', $old);
    if ($new === '') {
        // if result is empty, skip to avoid blank codes
        $skipped++;
        continue;
    }
    if ($new !== $old) {
        $alumno->codigo = $new;
        $alumno->save();
        $modified++;
        echo "Updated alumno id={$alumno->id} from '{$old}' to '{$new}'\n";
    }
}

echo "Done. Modified={$modified}, Skipped(empty)={$skipped}\n";
