<?php

namespace App\Http\Controllers\Admin;

use App\Models\MovieRoom;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Slot;
use App\Models\Room;
use App\Models\Movie;
use Illuminate\Support\Facades\Storage;

class MovieRoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $movieRooms = MovieRoom::all();
        return view('admin.projections.index', compact('movieRooms'));
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
    public function store(Request $request)
    {
        $data = $request->all();
        $new_movie_room = new MovieRoom();
        $room = Room::findOrFail($data['room_id']);
        if ($room->isense == 1) {
            $data['final_ticket_price'] = $room->base_price + 3;
        } else {
            $data['final_ticket_price'] = $room->base_price;
        }
        $new_movie_room->fill($data);
        $new_movie_room->save();
        // if ($request->has('room_id')) {
        //     $new_movie_room->room()->associate($request->room_id);
        // }
        // if ($request->has('movie_id')) {
        //     $new_movie_room->movie()->associate($request->movie_id);
        // }
        // if ($request->has('slot_id')) {
        //     $new_movie_room->slot()->associate($request->slot_id);
        // };

        return redirect()->route('admin.projections.index');
    }


    /**
     * Display the specified resource.
     */
    public function show(MovieRoom $movieRoom)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MovieRoom $movieRoom)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MovieRoom $movieRoom)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MovieRoom $movieRoom)
    {
        //
    }
}
