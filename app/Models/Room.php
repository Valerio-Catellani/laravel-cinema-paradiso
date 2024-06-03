<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
    ];
}
