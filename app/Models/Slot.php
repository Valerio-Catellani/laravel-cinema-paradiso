<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\MovieRoom;

class Slot extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'start_time',
        'end_time',

    ];

    public function movie_rooms()
    {
        return $this->hasMany(MovieRoom::class);
    }
}
