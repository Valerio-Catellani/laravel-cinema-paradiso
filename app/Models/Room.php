<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Movie;
use App\Models\MovieRoom;
use Illuminate\Support\Str;

class Room extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'alias',
        'hex_color',
        'seats',
        'base_price',
        'room_image',
        'isense',
        'slug'
    ];

    public function movies()
    {
        return $this->belongsToMany(Movie::class)->using(MovieRoom::class)->withPivot('date', 'final_ticket_price', 'slot_id');
    }


    public static function generateSlug($title)
    {
        $slug = Str::slug($title, '-');
        $count = 1;
        while (Room::where('slug', $slug)->first()) {
            $slug = Str::of($title)->slug('-') . "-{$count}";
            $count++;
        }
        return $slug;
    }
}
