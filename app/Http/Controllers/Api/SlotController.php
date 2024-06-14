<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Slot;
use Illuminate\Http\Request;

class SlotController extends Controller
{
    public function index(Request $request)
    {

        $slots = Slot::with(['movie_rooms.movie', 'movie_rooms.slot', 'movie_rooms.room'])->paginate(5);
        if ($slots) {
            return response()->json(
                [
                    'status' => 'success',
                    'message' => 'ok',
                    'results' => $slots
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
        $slots = Slot::where('slug', $slug)->with(['movie_rooms.movie', 'movie_rooms.slot', 'movie_rooms.room'])->first();
        if ($slots) {
            return response()->json(
                [
                    'status' => 'success',
                    'message' => 'ok',
                    'results' => $slots
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
