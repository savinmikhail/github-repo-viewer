<?php

use App\Http\Controllers\GitHubController;
use App\Http\Controllers\OwnerController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/repositories', [GitHubController::class, 'getTopRepositories']);
Route::get('/owners', [OwnerController::class, 'index'])->name('owners');
Route::post('/owner', [OwnerController::class, 'add'])->name('owner.add');
Route::delete('/owner/{name}', [OwnerController::class, 'delete'])->name('owner.delete');
