<?php

use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// Tentukan apakah aplikasi berada dalam mode pemeliharaan...
if (file_exists($maintenance = __DIR__.'/../storage/framework/maintenance.php')) {
    require $maintenance;
}

// Daftarkan autoloader Composer...
require __DIR__.'/../vendor/autoload.php';

// Bootstraps Laravel dan tangani permintaan...
$app = require_once __DIR__.'/../bootstrap/app.php';
$request = Illuminate\Http\Request::capture();
$app->handleRequest($request);
