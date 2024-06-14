<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Room;


class RoomController extends Controller
{
    public function index(Request $request)
    {
        // if ($request->query('type')) {
        //     $movies = Movie::with('type', 'technologies')->where('type_id', $request->query('type'))->paginate(5);
        // } else {

        //     $movies = Movie::paginate(5);
        // }

        $rooms = Room::with('movies')->paginate(10);
        if ($rooms) {
            return response()->json(
                [
                    'status' => 'success',
                    'message' => 'ok',
                    'results' => $rooms
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
        $room = Room::where('slug', $slug)->with('movies')->first();
        if ($room) {
            return response()->json(
                [
                    'status' => 'success',
                    'message' => 'ok',
                    'results' => $room
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
