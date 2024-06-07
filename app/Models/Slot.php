<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\MovieRoom;

class Slot extends Model
{
    use HasFactory;

    public function movie_rooms()
    {
        return $this->hasMany(MovieRoom::class);
    }
}
