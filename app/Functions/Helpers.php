<?php

namespace App\Functions;

//require_once 'C:\MAMP\htdocs\laravel-cinema-paradiso-1\vendor\autoload.php';
require_once __DIR__ . '/../../vendor/autoload.php';
// use App\Functions\Helpers as Help; se vogliamo usare una funzione Help::'nomefunzione'



class Helpers
{
    public static function getCsvData($path)
    {
        $file_stream = fopen($path, "r");
        if ($file_stream === false) {
            exit('Cannot open the file' . $path);
        }
        $data = [];
        while ($row = fgetcsv($file_stream)) {
            $data[] = $row;
        }
        fclose($file_stream);
        return $data;
    }

    public static function getStars($number)
    {
        $fullTemplate = '';
        for ($i = 0; $i < 10; $i++) {
            if ($i < $number) {
                $fullTemplate .= '<i class="fa-solid fa-star text-warning hype-text-shadow"></i>';
            } else {
                $fullTemplate .= '<i class="fa-regular fa-star hype-text-shadow-white "></i>';
            }
        }
        return $fullTemplate;
    }

    public static function getMovieData()
    {

        $client = new \GuzzleHttp\Client([
            'verify' => false,
        ]);

        $API_KEY = 'Bearer eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiJhNzc3YTI4ZTFiZDFlYjY4OWU5NjEyZThmNTI5OGRlOCIsInN1YiI6IjY2MWY3ZmNlN2FlY2M2MDE0OTZiMmM2YiIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.sw4oBdm-WsXuWzhIf-iB9nXpunWqsepfSuyTqpTxDvU';

        $response = $client->request('GET', 'https://api.themoviedb.org/3/movie/popular?language=en-US&page=1', [
            'headers' => [
                'Authorization' => $API_KEY,
                'accept' => 'application/json',
            ],
        ]);

        $body = $response->getBody();
        $data = json_decode($body);
        $array_of_data = [];

        foreach ($data->results as $movie) {
            $movie_data = [];
            $movie_data['title'] = $movie->title;
            $movie_data['overview'] = $movie->overview;
            $movie_data['poster_path'] = 'https://image.tmdb.org/t/p/w500' . $movie->poster_path;
            $movie_data['backdrop_path'] = 'https://image.tmdb.org/t/p/w500' . $movie->backdrop_path;
            $movie_data['avarage_rating'] = $movie->vote_average;
            $movie_data['theMovieDb_id'] = $movie->id;
            $movie_data['original_language'] = $movie->original_language;
            $array_of_data[] = $movie_data;
        }
        return $array_of_data;
    }
}


/*
php artisan db:seed --class=RoomSeeder
php artisan db:seed --class=MovieSeeder
php artisan db:seed --class=ReviewSeeder
php artisan db:seed --class=SlotSeeder
php artisan db:seed --class=MovieRoomSeeder

ciao a tutti




*/