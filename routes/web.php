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

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::middleware('auth:sanctum')->group(function () {
    Route::get(
        'publications',
        [
            App\Http\Controllers\PublicationController::class,
            'index'
        ]
    )->name('publication.index');
    Route::get(
        'publications/{publication}',
        [
            App\Http\Controllers\PublicationController::class,
            'show'
        ]
    )->name('publication.show');
    Route::post(
        'publications/{publication}/comments/store',
        [
            App\Http\Controllers\CommentController::class,
            'store'
        ]
    )->name('publication.comment.store');
    Route::get(
        'users/{user}/publications',
        [
            App\Http\Controllers\PublicationController::class,
            'user_index'
        ]
    )->name('user.publication.index');
    Route::get(
        'users/{user}/publications/{id}',
        [
            App\Http\Controllers\PublicationController::class,
            'user_show'
        ]
    )->name('user.publication.show');
});
