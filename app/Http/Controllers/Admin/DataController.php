<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\MovieRoom;
use App\Http\Controllers\Controller;

class DataController extends Controller
{
    public function getData(Request $request)
    {
        if ($request->has('movie_id')) {
            $date_data = $request->query('date');
            $movie_data = $request->query('movie_id');

            $all_results = MovieRoom::whereDate('date', $date_data)
                ->where('movie_id', $movie_data)
                ->get();
            return response()->json(['all_results' => $all_results]);
        } else if ($request->has('date')) {
            $date_data = $request->query('date');
            $all_results = MovieRoom::whereDate('date', $date_data)->get();
            return response()->json(['all_results' => $all_results]);
        }
    }
}
