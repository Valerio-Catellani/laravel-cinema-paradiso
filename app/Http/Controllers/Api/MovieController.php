<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Movie;

class MovieController extends Controller
{
    public function index(Request $request)
    {
        // if ($request->query('type')) {
        //     $movies = Movie::with('type', 'technologies')->where('type_id', $request->query('type'))->paginate(5);
        // } else {

        //     $movies = Movie::paginate(5);
        // }

        $movies = Movie::with('rooms')->paginate(5);
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
