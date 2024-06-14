<?php

namespace App\Functions;

/* require_once 'C:\esercizi-boolean\laravel-cinema-paradiso\vendor\autoload.php'; */
// require_once 'C:\MAMP\htdocs\laravel-cinema-paradiso-1\vendor\autoload.php';
// require_once 'C:\Desktop_nuovo\esercizi-boolean\Laravel\laravel-cinema-paradiso-1/vendor/autoload.php';
require_once __DIR__ . '/../../vendor/autoload.php';



use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class API_request
{
    private static $API_KEY = 'Bearer eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiJhNzc3YTI4ZTFiZDFlYjY4OWU5NjEyZThmNTI5OGRlOCIsInN1YiI6IjY2MWY3ZmNlN2FlY2M2MDE0OTZiMmM2YiIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.sw4oBdm-WsXuWzhIf-iB9nXpunWqsepfSuyTqpTxDvU';

    public static function getMovieData()
    {
        $client = new Client([
            'verify' => false,
        ]);

        try {
            $response = $client->request('GET', 'https://api.themoviedb.org/3/movie/popular?language=en-US&page=1', [
                'headers' => [
                    'Authorization' => self::$API_KEY,
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
                $movie_data['avarage_rating'] = $movie->vote_average; // Corretto da 'avarage_rating' a 'average_rating'
                $movie_data['theMovieDb_id'] = $movie->id;
                $movie_data['original_language'] = $movie->original_language;
                $array_of_data[] = $movie_data;
            }

            return $array_of_data;
        } catch (RequestException $e) {
            // Gestione degli errori
            echo "Errore nella richiesta API: " . $e->getMessage();
            return [];
        }
    }


    public static function getReviewMovieData($my_movie_id)
    {
        $client = new Client([
            'verify' => false,
        ]);
        try {
            $response = $client->request('GET', "https://api.themoviedb.org/3/movie/{$my_movie_id}/reviews?language=en-US&page=1", [
                'headers' => [
                    'Authorization' => self::$API_KEY,
                    'accept' => 'application/json',
                ],
            ]);

            $body = $response->getBody();
            $data = json_decode($body);

            $array_of_data = [];
            if ($data->total_results < 5) {
                foreach ($data->results as $review) {
                    $review_data = [];
                    $review_data['author'] = $review->author;
                    $review_data['content'] = $review->content;
                    $review_data['posted_at'] = $review->created_at;
                    $review_data['user_rating'] = random_int(1, 10);
                    $array_of_data[] = $review_data;
                }
            } else if ($data->total_results >= 5) {
                for ($i = 0; $i < 5; $i++) {
                    $review = $data->results[$i];
                    $review_data = [];
                    $review_data['author'] = $review->author;
                    $review_data['content'] = $review->content;
                    $review_data['posted_at'] = $review->created_at;
                    $review_data['user_rating'] = random_int(1, 10);
                    $array_of_data[] = $review_data;
                }
            }

            return $array_of_data;
        } catch (RequestException $e) {
            // Gestione degli errori
            echo "Errore nella richiesta API: " . $e->getMessage();
            return [];
        }
    }
}
