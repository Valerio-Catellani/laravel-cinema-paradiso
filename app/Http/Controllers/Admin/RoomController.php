<?php

namespace App\Http\Controllers\Admin;

use App\Models\Room;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRoomRequest;
use App\Http\Requests\UpdateRoomRequest;
use App\Models\MovieRoom;
use App\Models\Slot;
use Carbon\Carbon;
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
        $form_data["slug"] =  Room::generateSlug($form_data["name"]);
        if ($request->hasFile('room_image')) {
            $img_path = Storage::put('room_images', $request->room_image);
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
    public function show($slug)
    {

        $room = Room::where('slug', $slug)->firstOrFail();
        $today = Carbon::today();
        $slots = Slot::all();
        $nextWeek = $today->copy()->addDays(7);

        $projections = MovieRoom::where('room_id', $room->id)
            ->where('date', '>=', $today)
            ->where('date', '<=', $nextWeek)
            ->orderBy('date', 'asc')
            ->with('movie', 'slot', 'room')
            ->get();

        $groupedProjections = $projections->groupBy('date');
        return view("admin.rooms.show", compact("room", "groupedProjections", 'slots'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($slug)
    {
        $room = Room::where('slug', $slug)->firstOrFail();
        return view("admin.rooms.edit", compact("room"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRoomRequest $request, $slug)
    {
        $room_to_update = Room::where('slug', $slug)->firstOrFail();
        $form_data = $request->validated();
        $form_data['isense'] === 'true' ? $form_data['isense'] = 1 : $form_data['isense'] = 0;
        if ($room_to_update->name != $form_data["name"]) {
            $form_data["slug"] =  Room::generateSlug($form_data["name"]);
        }
        if ($request->hasFile('room_image')) {
            if ($room_to_update->room_image) {
                Storage::delete($room_to_update->room_image);
            }
            $img_path = Storage::put('my_images', $request->room_image);
            $form_data['room_image'] = $img_path;
        }
        $room_to_update->fill($form_data);
        $room_to_update->update();
        return redirect()->route('admin.rooms.index')->with('message', "Stanza (id:{$room_to_update->id}): {$room_to_update->name} aggiornato con successo");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($slug)
    {
        $room = Room::where('slug', $slug)->firstOrFail();
        $room->delete();
        return redirect()->route('admin.rooms.index')->with('message', "Stanza (id:{$room->id}): {$room->name} eliminato con successo");
    }
}
