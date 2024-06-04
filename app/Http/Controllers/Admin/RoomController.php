<?php

namespace App\Http\Controllers\Admin;

use App\Models\Room;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $rooms = Room::all();
        return view('admin.rooms.index', compact('rooms'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.rooms.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $form_data = $request->all();

        if ($request->hasFile('room_image')) {
            $img_path = Storage::put('room_images', $request->room_image); //questa funzione ritorna il path dell'immagine (nelle validazioni ricorda che puoi anche dire |image|)
            //    /storage/post_images/nomefile.jpg
            $form_data['room_image'] = $img_path;
        }
        $new_room = Room::create($form_data);
        return redirect()->route('admin.rooms.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Room $room)
    {
        return view('admin.rooms.show', compact('room'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Room $room)
    {
        return view('admin.rooms.edit', compact('room'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $room_to_update = Room::findOrFail($id);
        $form_data = $request->all();
        $room_to_update->fill($form_data);
        $room_to_update->update();
        return redirect()->route('admin.rooms.index')->with('message', "Project (id:{$room_to_update->id}): {$room_to_update->title} aggiornato con successo");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Room $room)
    {
        $room->delete();
        return redirect()->route('admin.rooms.index')->with('message', "Project (id:{$room->id}): {$room->title} eliminato con successo");
    }
}
