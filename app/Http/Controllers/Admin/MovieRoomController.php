<?php

namespace App\Http\Controllers\Admin;

use App\Models\MovieRoom;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMovieRoomRequest;
use App\Http\Requests\UpdateMovieRoomRequest;
use App\Models\Slot;
use App\Models\Room;
use App\Models\Movie;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class MovieRoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projections = MovieRoom::orderBy('date')->paginate(15);
        return view('admin.projections.index', compact('projections'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $slots = Slot::all();
        $rooms = Room::all();
        $movies = Movie::all();
        return view('admin.projections.create', compact('slots', 'rooms', 'movies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMovieRoomRequest $request)
    {
        $validated_data = $request->validated();
        $room = Room::findOrFail($validated_data['room_id']);
        // Calcola il prezzo finale del biglietto
        if ($room->isense == 1) {
            $validated_data['final_ticket_price'] = $room->base_price + 3;
        } else {
            $validated_data['final_ticket_price'] = $room->base_price;
        }

        // Crea la nuova proiezione
        $new_movie_room = new MovieRoom();
        $new_movie_room->fill($validated_data);
        $new_movie_room->save();

        return redirect()->route('admin.projections.index');
    }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $projection = MovieRoom::findOrFail($id);
        return view('admin.projections.show', compact('projection'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $slots = Slot::all();
        $rooms = Room::all();
        $movies = Movie::all();
        $projection = MovieRoom::findOrFail($id);
        $info = [
            'slots' => $slots,
            'rooms' => $rooms,
            'movies' => $movies,
            'projection' => $projection
        ];

        return view('admin.projections.edit', $info);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMovieRoomRequest $request, $id)
    {
        $validated_data = $request->validated();
        $room = Room::findOrFail($validated_data['room_id']);
        $projection_to_change = MovieRoom::findOrFail($id);
        // Calcola il prezzo finale del biglietto
        if ($room->isense == 1) {
            $validated_data['final_ticket_price'] = $room->base_price + 3;
        } else {
            $validated_data['final_ticket_price'] = $room->base_price;
        }

        $projection_to_change->fill($validated_data);
        $projection_to_change->update();

        return redirect()->route('admin.projections.show', $projection_to_change->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MovieRoom $movieRoom)
    {
        //
    }
}
