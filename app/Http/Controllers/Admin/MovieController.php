<?php

namespace App\Http\Controllers\Admin;

use App\Models\Movie;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\UpdateMovieRequest;
use App\Models\Slot;
use App\Http\Requests\StoreMovieRequest;


class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $movies = Movie::paginate(5);
        return view('admin.movies.index', compact('movies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.movies.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMovieRequest $request)
    {
        $form_data = $request->validated();
        $form_data["slug"] =  Movie::generateSlug($form_data["title"]);
        if ($request->hasFile('poster_path')) {
            $img_path = Storage::put('poster_path', $request->poster_path);
            $form_data['poster_path'] = $img_path;
        }
        if ($request->hasFile('backdrop_path')) {
            $img_path = Storage::put('backdrop_path', $request->backdrop_path);
            $form_data['backdrop_path'] = $img_path;
        }
        $new_movie = new Movie();
        $new_movie->fill($form_data);
        $new_movie->save();
        return redirect()->route('admin.movies.index');
    }

    /**
     * Display the specified resource.
     */
    public function show($slug)
    {
        $movie = Movie::where('slug', $slug)->firstOrFail();;
        return view('admin.movies.show', compact('movie'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($slug)
    {
        $movie = Movie::where('slug', $slug)->firstOrFail();
        return view('admin.movies.edit', compact('movie'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMovieRequest $request, $slug)
    {

        $movie_to_update = Movie::where('slug', $slug)->firstOrFail();
        $form_data = $request->validated();
        // $form_data = $request->all();
        if ($movie_to_update->title != $form_data['title']) {
            $form_data['slug'] = Movie::generateSlug($form_data['title']);
        }
        if ($request->hasFile('poster_path')) {
            if ($movie_to_update->poster_path) {
                Storage::delete($movie_to_update->poster_path);
            }
            $img_path = Storage::put('poster_path', $request->poster_path);
            $form_data['poster_path'] = $img_path;
        }
        if ($request->hasFile('backdrop_path')) {
            if ($movie_to_update->backdrop_path) {
                Storage::delete($movie_to_update->backdrop_path);
            }
            $img_path = Storage::put('backdrop_path', $request->backdrop_path);
            $form_data['backdrop_path'] = $img_path;
        }
        $movie_to_update->fill($form_data);
        $movie_to_update->update();
        return redirect()->route('admin.movies.index')->with('message', "Film (id:{$movie_to_update->id}): {$movie_to_update->title} aggiornato con successo");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($slug)
    {
        $movie = Movie::where('slug', $slug)->firstOrFail();
        $movie->delete();
        return redirect()->route('admin.movies.index')->with('message', "Film (id:{$movie->id}): {$movie->title} eliminato con successo dal db");
    }
}
