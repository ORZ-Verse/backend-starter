<?php

use App\Helpers\Response;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return Response::success(null, [
        'php_version' => phpversion(),
        'laravel_version' => app()->version()
    ]);
});
