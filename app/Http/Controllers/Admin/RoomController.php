<?php

namespace App\Http\Controllers\Admin;

use App\Models\Room;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRoomRequest;
use App\Http\Requests\UpdateRoomRequest;
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
    public function store(StoreRoomRequest $request)
    {
        $form_data = $request->validated();
        $form_data['isense'] === 'true' ? $form_data['isense'] = 1 : $form_data['isense'] = 0;
        if ($request->hasFile('room_image')) {
            $img_path = Storage::put('room_images', $request->room_image); //questa funzione ritorna il path dell'immagine (nelle validazioni ricorda che puoi anche dire |image|)
            //    /storage/post_images/nomefile.jpg
            $form_data['room_image'] = $img_path;
        }
        $new_room = new Room();
        $new_room->fill($form_data);
        $new_room->save();
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
    public function update(UpdateRoomRequest $request, $id)
    {
        $room_to_update = Room::findOrFail($id);
        $form_data = $request->validated();
        $form_data['isense'] === 'true' ? $form_data['isense'] = 1 : $form_data['isense'] = 0;
        if ($request->hasFile('room_image')) {
            if ($room_to_update->room_image) {
                Storage::delete($room_to_update->room_image);
            }
            $img_path = Storage::put('my_images', $request->room_image);
            $form_data['room_image'] = $img_path;
        }
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
