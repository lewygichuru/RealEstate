<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

$user = App\Models\User::first();
Auth::login($user);
$albums = App\Models\Album::latest('created_at')->with('files')->get();

// We need to set the view context properly.
try {
    echo view('admin.galleries.album', ['albums' => $albums, 'countmessages' => 0, 'navbarmessages' => collect()])->render();
    echo "RENDERED SUCCESSFULLY";
} catch (\Throwable $e) {
    echo "ERROR:\n" . $e->getMessage() . "\n" . $e->getFile() . ":" . $e->getLine() . "\n";
}
