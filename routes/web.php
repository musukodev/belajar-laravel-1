<?php

// use App\Http\Middleware\CheckMembership;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MovieController;


Route::get('/', function () {
    return view('welcome');
});

$movies = [];

Route::group(['prefix' => 'movie', 'middleware' => ['isAuth'], 'as' => 'movie.'], function () use ($movies) {
    Route::get('/', [MovieController::class, 'index']);
    
    Route::get('/{id}', [MovieController::class, 'show']);
    
    Route::post('/', [MovieController::class, 'store']);

    Route::put('/{id}', [MovieController::class, 'update']);

    Route::delete('/{id}', [MovieController::class, 'destroy']);

});
Route::get('/pricing', function () {
    return "Please subscribe to our membership to access movie details.";
});
Route::get('/login', function () {
    return "Please log in to access the movie details.";
})->name('login');