<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\UpdateSlotRequest;
use App\Http\Requests\StoreSlotRequest;
use App\Models\Slot;
use App\Models\MovieRoom;
use App\Models\Room;
use Carbon\Carbon;

use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;
use App\Http\Controllers\Controller;

class SlotController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $slots = Slot::all();
        return view('admin.slots.index', compact('slots'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.slots.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSlotRequest $request)
    {

        $validated_data = $request->validated();
        $validated_data["slug"] =  Slot::generateSlug($validated_data["name"]);
        $new_slot = new Slot();
        $new_slot->fill($validated_data);
        $new_slot->save();
        return redirect()->route('admin.slots.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, $slug)
    {

        $slot = Slot::where('slug', $slug)->firstOrFail();
        if (!empty($request->query('date'))) {
            $projections = MovieRoom::where('date', $request->query('date'))
                ->where('slot_id', $slot->id)->paginate(10);
        } else {
            $projections = MovieRoom::where('slot_id', $slot->id)->paginate(10);
        }
        $AllProjections = MovieRoom::all();
        $rooms = Room::all();
        $info = [
            'projections' => $projections,
            'AllProjections' => $AllProjections,
            'slot' => $slot,
            'date' => $request->query('date'),
            'rooms' => $rooms
        ];
        return view('admin.slots.show', $info);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($slug)
    {

        $slot = Slot::where('slug', $slug)->firstOrFail();
        return view('admin.slots.edit', compact('slot'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSlotRequest $request, $slug)
    {
        // Trova lo slot da aggiornare
        $slot_to_update = Slot::where('slug', $slug)->firstOrFail();

        // Ottieni i dati validati dalla richiesta

        $validated_data = $request->validated();

        // Aggiorna il modello con i dati validati
        $slot_to_update->fill($validated_data);
        $slot_to_update->save();

        // Ritorna con un messaggio di successo
        return redirect()->route('admin.slots.index')
            ->with('message', "Fascia Oraria (id:{$slot_to_update->id}): {$slot_to_update->name} aggiornata con successo");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($slug)
    {
        $slot = Slot::where('slug', $slug)->firstOrFail();
        $slot->delete();
        return redirect()->route('admin.slots.index')->with('message', "La Fascia Oraria con id: ({$slot->id}):  è stata eliminata con successo dal db");
    }
}
