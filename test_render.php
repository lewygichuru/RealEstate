<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

try {
    echo view('admin.galleries.album', ['albums' => App\Models\Album::latest('created_at')->with('files')->get()])->render();
    echo "\n\nNO ERROR\n";
} catch (Exception $e) {
    echo "ERROR:\n" . $e->getMessage() . "\n" . $e->getFile() . ":" . $e->getLine() . "\n";
} catch (Error $e) {
    echo "ERROR:\n" . $e->getMessage() . "\n" . $e->getFile() . ":" . $e->getLine() . "\n";
}
