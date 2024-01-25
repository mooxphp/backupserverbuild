<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BackupController;
use App\Http\Controllers\Api\SourceController;
use App\Http\Controllers\Api\DestinationController;
use App\Http\Controllers\Api\BackupLogItemController;
use App\Http\Controllers\Api\SourceBackupsController;
use App\Http\Controllers\Api\DestinationBackupsController;
use App\Http\Controllers\Api\DestinationSourcesController;
use App\Http\Controllers\Api\BackupBackupLogItemsController;
use App\Http\Controllers\Api\SourceBackupLogItemsController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/login', [AuthController::class, 'login'])->name('api.login');

Route::middleware('auth:sanctum')
    ->get('/user', function (Request $request) {
        return $request->user();
    })
    ->name('api.user');

Route::name('api.')
    ->middleware('auth:sanctum')
    ->group(function () {
        Route::apiResource('backups', BackupController::class);

        // Backup Backup Log Items
        Route::get('/backups/{backup}/backup-log-items', [
            BackupBackupLogItemsController::class,
            'index',
        ])->name('backups.backup-log-items.index');
        Route::post('/backups/{backup}/backup-log-items', [
            BackupBackupLogItemsController::class,
            'store',
        ])->name('backups.backup-log-items.store');

        Route::apiResource('backup-log-items', BackupLogItemController::class);

        Route::apiResource('destinations', DestinationController::class);

        // Destination Backups
        Route::get('/destinations/{destination}/backups', [
            DestinationBackupsController::class,
            'index',
        ])->name('destinations.backups.index');
        Route::post('/destinations/{destination}/backups', [
            DestinationBackupsController::class,
            'store',
        ])->name('destinations.backups.store');

        // Destination Sources
        Route::get('/destinations/{destination}/sources', [
            DestinationSourcesController::class,
            'index',
        ])->name('destinations.sources.index');
        Route::post('/destinations/{destination}/sources', [
            DestinationSourcesController::class,
            'store',
        ])->name('destinations.sources.store');

        Route::apiResource('sources', SourceController::class);

        // Source Backups
        Route::get('/sources/{source}/backups', [
            SourceBackupsController::class,
            'index',
        ])->name('sources.backups.index');
        Route::post('/sources/{source}/backups', [
            SourceBackupsController::class,
            'store',
        ])->name('sources.backups.store');

        // Source Backup Log Items
        Route::get('/sources/{source}/backup-log-items', [
            SourceBackupLogItemsController::class,
            'index',
        ])->name('sources.backup-log-items.index');
        Route::post('/sources/{source}/backup-log-items', [
            SourceBackupLogItemsController::class,
            'store',
        ])->name('sources.backup-log-items.store');
    });
