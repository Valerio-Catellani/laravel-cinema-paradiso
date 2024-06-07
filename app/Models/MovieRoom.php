<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Slot;
use Illuminate\Database\Eloquent\Relations\Pivot;

class MovieRoom extends Pivot
{
    use HasFactory;

    protected $fillable = [
        'date',
        'final_ticket_price',
        'slot_id',
        'movie_id',
        'room_id'
    ];

    public function slot()
    {
        return $this->belongsTo(Slot::class);
    }

    public function movie()
    {
        return $this->belongsTo(Movie::class);
    }

    public function room()
    {
        return $this->belongsTo(Room::class);
    }
}
