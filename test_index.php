<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

try {
    $response = app()->make('\App\Http\Controllers\FrontpageController')->index();
    echo $response->render();
    echo "Success!";
} catch (\Throwable $e) {
    echo "REAL ERROR: " . $e->getMessage() . " in " . $e->getFile() . " on line " . $e->getLine();
}
