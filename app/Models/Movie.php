<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Review;
use App\Models\Room;
use Illuminate\Support\Str;


class Movie extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'overview',
        'poster_path',
        'backdrop_path',
        'avarage_rating',
        'theMovieDb_id',
        'original_language',
        'slug'
    ];

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function rooms() //$movie->rooms->name
    {
        return $this->belongsToMany(Room::class)->using(MovieRoom::class)->withPivot('date', 'final_ticket_price', 'slot_id');
    }



    public static function generateSlug($title)
    {
        $slug = Str::slug($title, '-');
        $count = 1;
        while (Movie::where('slug', $slug)->first()) {
            $slug = Str::of($title)->slug('-') . "-{$count}";
            $count++;
        }
        return $slug;
    }
}
