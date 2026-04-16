<?php

// use App\Http\Middleware\CheckMembership;
use App\Http\Controllers\HomeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MovieController;
use Illuminate\Support\Facades\Response;


Route::get('/', function () {
    return view('welcome');
});

$movies = [];

Route::group(['prefix' => 'movie', 'as' => 'movie.'], function () use ($movies) {
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
// Route::get('/request', function (Request $request) {
//     // $filtered = $request->collect()->map(function ($value){
//     //     return strtoupper($value);
//     // });
//     // return $filtered;
//     $filtered = $request->collect()->only(['title', 'year']);
//     return $filtered;
// });

// Route::post('/request', function (Request $request) {
//     $input = $request->input('warna.*');
//     return $input;
// });

// Route::post('/request', function (Request $request) {
//     $data = $request->date('schedule', 'Y-m-d', 'Asia/Jakarta');
//     return $data->diffForHumans();
// });

// Route::post('/request', function (Request $request){
//     // if ($request->has("email", "password")){
//     //     return "Login Berhasil. OK";
//     // }
//     if ($request->hasAny("title", "description")){
//         return "Datanya ada";
//     }
//     return "Gagal";
// });

// Route::post('/request', function (Request $request){
//     $request->merge(["email" => "haloo@mail.com"]);
//     if ($request->missing("email")){
//         return "Email tidak ada";
//     } else{
//         return "Ada semua datanya";
//     }
// });

Route::get('/response', function () {
    return response("ERROR", 404)->header("Content-type", "text/plain");
});

Route::get('/cache-control', function () {
    return Response::make("page allow to cache", 200)
        ->header("Cache-Control", "public, max-age=86400");
});
Route::middleware('cache.headers:public;max_age=30;s_maxage=300;stale_while_revalidate=600;etag')->group(function () {

    Route::get("/home", [HomeController::class, "index"])->name("home");

    Route::get("/dashboard", function () {
        return response("Login Successfully", 200)->cookie("user", "admin");
    });

    Route::get("/logout", function(){
        return redirect()->action([HomeController::class, "index"], ["authenticated"=>false]);
    });

    Route::get('/privacy', function () {
        return "Privacy page";
    });

    Route::get('/terms', function () {
        return "Terms page";
    });
});

Route::get("/external", function(){
    return redirect()->away("https://nekopoi.care");
});
