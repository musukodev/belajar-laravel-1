<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;


class MovieController extends Controller implements HasMiddleware
{
    public $movies = [];
    public function __construct()
    {
        for ($i = 0; $i < 10; $i++) {
            $this->movies[] = [
                'title' => 'Movie Controller' . $i,
                'year' => 2020 + $i,
                'genre' => 'Action',
                'rating' => 8.0 + $i * 0.1,
            ];
        }
    }
    public static function middleware()
    {
        // return [
        //     "isAuth",
        //     new Middleware("isMember", only: ['show'])
        // ];
    }

    public function index()
    {
        $movies = $this->movies;
        // return view("movie.index", ['films' => $movies]); 
        return view("movie.index", compact("movies"))->with(
            [
                "titletess" => "List Movie"
            ]
        );
    }
    public function show($id)
    {
        $movies = $this->movies;
        return view("movie.show", ['movie' => $movies]);
    }
    public function store()
    {
        $this->movies[] = [
            'title' => request('title'),
            'year' => request('year'),
            'genre' => request('genre'),
            'rating' => request('rating'),
        ];
        return $this->movies;
    }
    public function update($id)
    {
        $this->movies[$id] = [
            'title' => request('title'),
            'year' => request('year'),
            'genre' => request('genre'),
            'rating' => request('rating'),
        ];
        return $this->movies;
    }
    public function destroy($id)
    {
        unset($this->movies[$id]);
        return $this->movies;
    }
}
