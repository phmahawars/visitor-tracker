<?php

use App\Http\Controllers\Admin\BotController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\VisitorController;
use App\Http\Middleware\SetCustomUserAgent;
use Illuminate\Support\Facades\Route;

Route::middleware([SetCustomUserAgent::class])->group(function () {

    // Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');

    // Visitor Logs
    Route::get('/logs', [VisitorController::class, 'logs'])->name('logs.index');
    Route::get('/blocked-ips', [VisitorController::class, 'blockedIp'])->name('ips.blocked');
    Route::post('/block-ip', [VisitorController::class, 'blockIp'])->name('ips.block');
    Route::post('/unblock-ip', [VisitorController::class, 'unblockIp'])->name('ips.unblock');

    // Blocked Bots
    Route::get('/bots', [BotController::class, 'list'])->name('bots.index');
    Route::post('/block-bot', [BotController::class, 'block'])->name('bots.block');
    Route::post('/unblock-bot', [BotController::class, 'unblock'])->name('bots.unblock');
});
