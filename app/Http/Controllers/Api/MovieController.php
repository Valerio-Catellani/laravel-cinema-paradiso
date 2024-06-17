<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Movie;
use App\Models\Room;
use App\Models\MovieRoom;
use Carbon\Carbon;


class MovieController extends Controller
{
    public function index(Request $request)
    {

        if ($request->query('date')) {
            $date = $request->query('date');
            $movies = Movie::whereHas('rooms', function ($query) use ($date) {
                $query->where('date', $date);
            })->get(); // Cambiato da get() a paginate(10) per mantenere la paginazione

        } elseif ($request->query('nextWeekDate') && $request->query('currentDate')) {

            $nextWeekDate = $request->query('nextWeekDate');
            $currentDate = $request->query('currentDate');
            $movies = Movie::whereHas('rooms', function ($query) use ($nextWeekDate, $currentDate) {
                $query->where('movie_room.date', '>=', $currentDate)
                    ->where('movie_room.date', '<=', $nextWeekDate);
            })->with('rooms')->get();
        } else {
            $movies = Movie::with('rooms')->get();
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

        $currentDate = Carbon::now();
        $nextWeekDate = Carbon::now()->addDays(7);

        $movie = Movie::where('slug', $slug)
            ->whereHas('rooms', function ($query) use ($nextWeekDate, $currentDate) {
                $query->where('movie_room.date', '>=', $currentDate)
                    ->where('movie_room.date', '<=', $nextWeekDate);
            })
            ->with(['rooms' => function ($query) {
                $query->withPivot('date', 'final_ticket_price', 'slot_id');
            }])
            ->first();


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
