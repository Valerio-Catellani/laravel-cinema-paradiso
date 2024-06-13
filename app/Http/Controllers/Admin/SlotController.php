<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\UpdateSlotRequest;
use App\Models\Slot;
use Illuminate\Http\Request;
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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Slot $slot)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Slot $slot)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSlotRequest $request, $id)
    {
        $slot_to_update = Slot::where('id', $id)->firstOrFail();
        $form_data = $request->validated();
        $slot_to_update->fill($form_data);
        $slot_to_update->update();
        return redirect()->route('admin.slots.index')->with('message', "Stanza (id:{$slot_to_update->id}): {$slot_to_update->name} aggiornato con successo");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Slot $slot)
    {
        //
    }
}
