<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

$request = Illuminate\Http\Request::create('/admin/galleries/album', 'GET');
// We must login first via a separate route to set the session, or mock it.
// To bypass this, let's just dispatch the route and catch exceptions inside.
$app->make('router')->get('/test-album', function () {
    $albums = App\Models\Album::latest('created_at')->with('files')->get();
    // mock the layout rendering by temporarily swapping out the layout
    // actually, let's just return the data to see if the query fails
    return $albums;
});
$request2 = Illuminate\Http\Request::create('/test-album', 'GET');
$response = $kernel->handle($request2);

echo "STATUS: " . $response->getStatusCode() . "\n";
if ($response->getStatusCode() == 500) {
    echo $response->getContent();
} else {
    echo $response->getContent();
}
