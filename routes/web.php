<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => 'auth'], function($router) {
    $router->get(
        '/template',
        [App\Http\Controllers\InvoiceController::class, 'template']
    )->name('template');

    $router->post(
        'invoices/create',
        [App\Http\Controllers\InvoiceController::class, 'store']
    );
});
