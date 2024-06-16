<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\MovieRoom;
use Illuminate\Http\Request;

class ProjectionController extends Controller
{
    public function index(Request $request)
    {
        if ($request->query('date') && $request->query('slot_id')) {
            $projections = MovieRoom::with('movie', 'slot', 'room')->where('date', $request->query('date'))->where('slot_id', $request->query('slot_id'))->paginate(10);
        } else {
            $projections = MovieRoom::with('movie', 'slot', 'room')->paginate(10);
        }

        if ($projections) {
            return response()->json(
                [
                    'status' => 'success',
                    'message' => 'ok',
                    'results' => $projections
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

    public function show($id)
    {
        $projection = MovieRoom::where('id', $id)->with('movie', 'slot', 'room')->first();
        if ($projection) {
            return response()->json(
                [
                    'status' => 'success',
                    'message' => 'ok',
                    'results' => $projection
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