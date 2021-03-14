<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\PublicationController;
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

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get(
        'publications',
        [PublicationController::class, 'index']
    )->name('publication.index');

    Route::get(
        'publications/{publication:slug}',
        [PublicationController::class, 'show']
    )->name('publication.show');

    Route::post(
        'publications/{publication}/comments/store',
        [CommentController::class, 'store']
    )->name('publication.comment.store');

    Route::get(
        'users/{user}/publications',
        [PublicationController::class, 'user_index']
    )->name('user.publication.index');

    Route::get(
        'users/{user}/publications/{id}',
        [PublicationController::class, 'user_show']
    )->name('user.publication.show');
});
