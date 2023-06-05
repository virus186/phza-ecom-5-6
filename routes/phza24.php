<?php

use App\Http\Controllers\Admin\Incevio;
use Illuminate\Support\Facades\Route;

Route::prefix('phza24')->group(function () {
    // Check different type system information
    Route::get('check/{option?}', [Incevio::class, 'check'])->name('phza24.check');

    // New version upgrade
    Route::get('upgrade/{option?}', [Incevio::class, 'upgrade'])->name('phza24.upgrade');

    // Run Artisan command
    Route::get('command/{option?}', [Incevio::class, 'command'])->name('phza24.command');

    // Clear config. cache etc
    Route::get('clear/{all?}', [Incevio::class, 'clear'])->name('phza24.clear');

    // Clear scout. cache etc
    // Route::get('scout/{all?}', [Incevio::class, 'scout'])->name('phza24.scout');
});
