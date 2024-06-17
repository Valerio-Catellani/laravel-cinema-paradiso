<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\MovieRoom;
use App\Models\Room;
use App\Models\Slot;
use App\Http\Controllers\Controller;

class DataController extends Controller
{
    public function getData(Request $request)
    {
        if ($request->has('inforequest')) {
            $roomsNumber = Room::count();
            $slotsNumber = Slot::count();

            return response()->json([
                'roomsNumber' => $roomsNumber,
                'slotsNumber' => $slotsNumber,
            ]);
        } else if ($request->has('infoEdit')) {


            if ($request->query('selectedDate') && $request->query('roomValue')) {
                $date_data = $request->query('selectedDate');
                $room_data = $request->query('roomValue');

                // Recupera gli slot già occupati
                $occupied_slots = MovieRoom::whereDate('date', $date_data)
                    ->where('room_id', $room_data)
                    ->pluck('slot_id')
                    ->toArray();

                // Recupera tutti gli slot possibili escludendo quelli già occupati
                $available_slots = Slot::whereNotIn('id', $occupied_slots)
                    ->pluck('id')
                    ->toArray();

                return response()->json(['available_slots' => $available_slots]);
            } else if ($request->query('selectedDate')) {
                $date_data = $request->query('selectedDate');
                $all_rooms = MovieRoom::whereDate('date', $date_data)
                    ->pluck('room_id')
                    ->toArray();
                $all_slots = MovieRoom::whereDate('date', $date_data)
                    ->pluck('slot_id')
                    ->toArray();
                return response()->json(['all_rooms' => $all_rooms, 'all_slots' => $all_slots]);
            }
        } else if ($request->has('movie_id')) {
            $date_data = $request->query('date');
            $movie_data = $request->query('movie_id');

            $all_results = MovieRoom::whereDate('date', $date_data)
                ->where('movie_id', $movie_data)
                ->get();
            return response()->json(['all_results' => $all_results]);
        } else if ($request->has('room_id') && $request->has('date')) {
            $room_data = $request->query('room_id');
            $date_data = $request->query('date');
            $all_results = MovieRoom::where('room_id', $room_data)
                ->whereDate('date', $date_data)
                ->get();
            return response()->json(['all_results' => $all_results]);
        } else if ($request->has('date')) {
            $date_data = $request->query('date');
            $all_results = MovieRoom::whereDate('date', $date_data)->get();
            return response()->json(['all_results' => $all_results]);
        }
    }
}
