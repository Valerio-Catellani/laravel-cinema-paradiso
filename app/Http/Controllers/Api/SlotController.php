<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Slot;
use Illuminate\Http\Request;

class SlotController extends Controller
{
    public function index(Request $request)
    {

        $slots = Slot::with('movie_rooms')->all();
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
        $slots = Slot::where('slug', $slug)->with('movie_rooms')->first();
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
