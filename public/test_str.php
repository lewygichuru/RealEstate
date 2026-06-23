<?php
require dirname(__DIR__) . '/vendor/autoload.php';

// Read .env content
$content = file_get_contents(dirname(__DIR__) . '/.env');

// Call Str::utf8 directly using reflection to access the internal class
try {
    $result = Dotenv\Util\Str::utf8($content, null);
    echo "Str::utf8 OK: " . strlen($result->getOrElse('')) . " chars\n";
} catch (Throwable $e) {
    echo get_class($e) . ": " . $e->getMessage() . "\n";
    echo $e->getTraceAsString() . "\n";
}
