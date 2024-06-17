<?php

namespace App\Http\Controllers\Admin;

use App\Models\Review;
use App\Models\Movie;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreReviewRequest;
use App\Http\Requests\UpdateReviewRequest;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reviews = Review::with('movie')->paginate(10);
        return view('admin.reviews.index', compact('reviews'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $movies = Movie::all();
        return view('admin.reviews.create', compact('movies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreReviewRequest $request)
    {
        $form_data = $request->validated();
        $new_review = new Review();
        $new_review->fill($form_data);
        $new_review->save();
        return redirect()->route('admin.reviews.show', $new_review->id);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $review = Review::where('id', $id)->firstOrFail();
        $authr = $review->author;
        $other_reviews = Review::where('author', $authr)->where('id', '!=', $id)->paginate(5);;
        return view('admin.reviews.show', compact('review', 'other_reviews'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $review = Review::where('id', $id)->firstOrFail();
        $movies = Movie::all();
        return view('admin.reviews.edit', compact('review', 'movies'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateReviewRequest $request, $id)
    {
        $form_data = $request->validated();
        $review = Review::where('id', $id)->firstOrFail();
        $review->update($form_data);
        return redirect()->route('admin.reviews.show', $review->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $review = Review::where('id', $id)->firstOrFail();
        $review->delete();
        return redirect()->route('admin.reviews.index')->with('message', "La Recensione con id: ({$review->id}): di {$review->author} è stata eliminata con successo dal db");
    }
}
