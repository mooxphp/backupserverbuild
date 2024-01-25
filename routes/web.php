<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BackupController;
use App\Http\Controllers\SourceController;
use App\Http\Controllers\DestinationController;
use App\Http\Controllers\BackupLogItemController;

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

Route::middleware(['auth:sanctum', 'verified'])
    ->get('/dashboard', function () {
        return view('dashboard');
    })
    ->name('dashboard');

Route::prefix('/')
    ->middleware(['auth:sanctum', 'verified'])
    ->group(function () {
        Route::resource('backups', BackupController::class);
        Route::resource('backup-log-items', BackupLogItemController::class);
        Route::resource('destinations', DestinationController::class);
        Route::resource('sources', SourceController::class);
    });
