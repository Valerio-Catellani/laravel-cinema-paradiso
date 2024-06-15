<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MovieRoom;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Ottieni la data di oggi
        $today = Carbon::today();

        // Esempio di utilizzo: ottieni le proiezioni ordinate per data
        $projections = MovieRoom::whereDate('date', $today)->orderBy('slot_id')->get();

        return view('admin.dashboard', compact('projections', 'today'));
    }
}
