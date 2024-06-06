<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Movie;
use App\Functions\API_request as API;

class MovieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = API::getMovieData();
        foreach ($data as $movie) {
            $new_movie = new Movie();
            $new_movie->title = $movie['title'];
            $new_movie->slug = Movie::generateSlug($movie['title']);
            $new_movie->overview = $movie['overview'];
            $new_movie->poster_path = $movie['poster_path'];
            $new_movie->backdrop_path = $movie['backdrop_path'];
            $new_movie->avarage_rating = $movie['avarage_rating'];
            $new_movie->theMovieDb_id = $movie['theMovieDb_id'];
            $new_movie->original_language = $movie['original_language'];
            $new_movie->save();
        }
    }
}
