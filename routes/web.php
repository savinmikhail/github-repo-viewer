<?php

use App\Http\Controllers\GetTopRepositoriesController;
use App\Http\Controllers\OwnerController;
use Illuminate\Support\Facades\Route;

Route::get('/', GetTopRepositoriesController::class);
Route::get('/owners', [OwnerController::class, 'index'])->name('owners');
Route::post('/owner', [OwnerController::class, 'add'])->name('owner.add');
Route::delete('/owner/{name}', [OwnerController::class, 'delete'])->name('owner.delete');
