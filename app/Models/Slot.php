<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\Models\MovieRoom;

class Slot extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'start_time',
        'end_time',
        'slug'
    ];

    public function movie_rooms()
    {
        return $this->hasMany(MovieRoom::class);
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
