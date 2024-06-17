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
use Illuminate\Database\Eloquent\SoftDeletes;


use Illuminate\Support\Facades\Storage;

class MovieRoomController extends Controller
{
    use SoftDeletes;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //Recupera tutte le proiezioni ordinate per data:
        $projections = MovieRoom::orderBy('date')->get();

        $today = Carbon::today();
        $nextWeek = $today->copy()->addDays(7);

        $projections = MovieRoom::where('date', '>=', $today)
            ->where('date', '<=', $nextWeek)
            ->orderBy('date', 'asc')
            ->with('movie', 'slot', 'room')
            ->get();


        //Raggruppa le proiezioni per data:
        $groupedProjections = $projections->groupBy('date')->sortBy('slot');
        $slots = Slot::all();
        $rooms = Room::all();



        // Numero di elementi per pagina

        // Pagina corrente (recuperata dalla richiesta, default a 1)


        // Slice manuale della Collection per ottenere solo gli elementi della pagina corrente

        return view('admin.projections.index', compact('groupedProjections', 'slots', 'rooms'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {

        if ($request->input('date')) {
            $date = $request->input('date');
        }
        if ($request->input('room_id')) {
            $room_from_show = $request->input('room_id');
        }
        if ($request->input('slot_id')) {
            $slot_from_show = $request->input('slot_id');
        }
        $slots = Slot::all();
        $rooms = Room::all();
        $movies = Movie::all();
        $info = [
            'slots' => $slots,
            'rooms' => $rooms,
            'movies' => $movies,
            'date' => $date ?? Carbon::now()->format('Y-m-d'),
            'room_from_show' => $room_from_show ?? '',
            'slot_from_show' => $slot_from_show ?? '',
        ];
        return view('admin.projections.create', $info);
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
        $room_id = $validated_data['room_id'];
        $slot_id = $validated_data['slot_id'];
        $date = $validated_data['date'];
        $All_rooms = Room::all();
        $All_Slots = Slot::all();
        $projection_for_date = MovieRoom::where('date', $date)->get();
        if ($projection_for_date->count() >= ($All_rooms->count() * $All_Slots->count())) {
            return redirect()->back()->with('error', 'Non ci sono Proiezioni disponibili per questa data');
        }
        $projection_with_rooms = MovieRoom::where('date', $date)->where('room_id', $room_id)->get();
        if ($projection_with_rooms->count() >= $All_Slots->count()) {
            return redirect()->back()->with('error', "La stanza  $room->name ($room->alias) non ha slot disponibili per questa data");
        }
        $projection_with_slots = MovieRoom::where('date', $date)->where('slot_id', $slot_id)->get();
        $slot = Slot::findOrFail($slot_id);
        if ($projection_with_slots->count() >= $All_rooms->count()) {
            return redirect()->back()->with('error', "La Fascia Oraria di $slot->name non ha stanze disponibili per questa data");
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

        $room_id = $validated_data['room_id'];
        $slot_id = $validated_data['slot_id'];
        $date = $validated_data['date'];
        $All_rooms = Room::all();
        $All_Slots = Slot::all();
        $projection_for_date = MovieRoom::where('date', $date)->get();
        if ($projection_for_date->count() >= ($All_rooms->count() * $All_Slots->count())) {
            return redirect()->back()->with('error', 'Non ci sono Proiezioni disponibili per questa data');
        }
        $projection_with_rooms = MovieRoom::where('date', $date)->where('room_id', $room_id)->get();
        if ($projection_with_rooms->count() >= $All_Slots->count()) {
            return redirect()->back()->with('error', "La stanza  $room->name ($room->alias) non ha slot disponibili per questa data");
        }
        $projection_with_slots = MovieRoom::where('date', $date)->where('slot_id', $slot_id)->get();
        $slot = Slot::findOrFail($slot_id);
        if ($projection_with_slots->count() >= $All_rooms->count()) {
            return redirect()->back()->with('error', "La Fascia Oraria di $slot->name non ha stanze disponibili per questa data");
        }

        $projection_to_change->fill($validated_data);
        $projection_to_change->update();

        return redirect()->route('admin.projections.show', $projection_to_change->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $projection = MovieRoom::findOrFail($id);
        $projection->delete();
        return redirect()->route('admin.projections.index')->with('message', "Proiezione (id:{$projection->id}) del giorno {$projection->date}  eliminata con successo");
    }
}
