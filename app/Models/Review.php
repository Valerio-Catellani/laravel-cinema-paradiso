<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Movie;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'author',
        'date',
        'content',
        'rating',
        'movie_id',
    ];


    public function movie()
    {
        return $this->belongsTo(Movie::class);
    }
}
