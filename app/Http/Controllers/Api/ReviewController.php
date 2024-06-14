<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{

    public function index(Request $request)
    {

        $reviews = Review::with('movie')->paginate(10);
        if ($reviews) {
            return response()->json(
                [
                    'status' => 'success',
                    'message' => 'ok',
                    'results' => $reviews
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
        $review = Review::where('id', $id)->with('movie')->first();
        if ($review) {
            return response()->json(
                [
                    'status' => 'success',
                    'message' => 'ok',
                    'results' => $review
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
