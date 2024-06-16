<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Movie;

class MovieController extends Controller
{
    public function index(Request $request)
    {

        if ($request->query('date')) {
            $date = $request->query('date');
            $movies = Movie::whereHas('rooms', function ($query) use ($date) {
                $query->where('date', $date);
            })->paginate(10); // Cambiato da get() a paginate(10) per mantenere la paginazione
        } elseif ($request->query('nextWeekDate') && $request->query('currentDate')) {

            $nextWeekDate = $request->query('nextWeekDate');
            $currentDate = $request->query('currentDate');
            $movies = Movie::whereHas('rooms', function ($query) use ($nextWeekDate, $currentDate) {
                $query->where('movie_room.date', '>=', $currentDate)
                    ->where('movie_room.date', '<=', $nextWeekDate);
            })->with('rooms')->paginate(10);
        } else {
            $movies = Movie::with('rooms')->paginate(10);
        }








        if ($movies) {
            return response()->json(
                [
                    'status' => 'success',
                    'message' => 'ok',
                    'results' => $movies
                ],
                200
            );
        } else {
            return response()->json(
                [
                    'status' => 'error',
                    'message' => 'error'
                ],
                400
            );
        }
    }

    public function show($slug)
    {
        $movie = Movie::where('slug', $slug)->with('rooms')->first();
        if ($movie) {
            return response()->json(
                [
                    'status' => 'success',
                    'message' => 'ok',
                    'results' => $movie
                ],
                200
            );
        } else {
            return response()->json(
                [
                    'status' => 'error',
                    'message' => 'Project not found'
                ],
                400
            );
        }
    }
}
