<?php
// Routes file

$routes = [
    '/' => 'App\Controllers\ReportController::index',
    '/client' => 'App\Controllers\ClientController::index',
    '/client/view/(\d+)' => 'App\Controllers\ClientController::view',
    '/client/add' => 'App\Controllers\ClientController::add',
    '/client/edit/(\d+)' => 'App\Controllers\ClientController::edit',
    '/client/delete' => 'App\Controllers\ClientController::delete',
    '/client/page/(\d+)' => 'App\Controllers\ClientController::index',
    '/client/data' => 'App\Controllers\ClientController::data',
    '/productor' => 'App\Controllers\ProductorController::index',
    '/productor/page/(\d+)' => 'App\Controllers\ProductorController::index',
    '/productor/view/(\d+)' => 'App\Controllers\ProductorController::view',
    '/productor/add' => 'App\Controllers\ProductorController::add',
    '/productor/edit/(\d+)' => 'App\Controllers\ProductorController::edit',
    '/productor/delete/(\d+)' => 'App\Controllers\ProductorController::delete',
];

return $routes;