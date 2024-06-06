<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Functions\API_request as API;
use App\Models\Review;
use App\Models\Movie;
use DateTime;


class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ottieni tutti i film con i loro ID dal database
        $movies = Movie::all(['id', 'theMovieDb_id']);

        // Itera su ciascun film
        foreach ($movies as $movie) {
            $movie_id = $movie->id; // ID del film nel database
            $theMovieDb_id = $movie->theMovieDb_id; // ID del film su TheMovieDb

            // Ottieni i dati delle recensioni dall'API
            $data = API::getReviewMovieData($theMovieDb_id);

            // Itera su ciascuna recensione e salvala nel database
            foreach ($data as $review) {
                $new_review = new Review();
                $new_review->movie_id = $movie_id; // ID del film nel database
                $new_review->author = $review['author'];
                $new_review->content = $review['content'];
                $new_review->rating = $review['user_rating'];
                $date = new DateTime($review['posted_at']);
                $formatted_date = $date->format('Y-m-d');
                $new_review->date = $formatted_date;
                $new_review->save();
            }
        }
    }
}
