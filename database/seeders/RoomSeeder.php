<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Room;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = json_decode(file_get_contents(__DIR__ . '\roomsDb.json'), true);
        foreach ($data as $room) {
            $new_room = new Room();
            $new_room->name = $room['name'];
            $new_room->alias = $room['alias'];
            $new_room->slug = Room::generateSlug($room['name']);
            $new_room->hex_color = $room['hex_color'];
            $new_room->seats = $room['seats'];
            $new_room->base_price = $room['base_price'];
            $new_room->room_image = $room['room_image'];
            $new_room->isense = $room['isense'];
            $new_room->save();
        }
    }
}
//php artisan db:seed –-class=NomeElementoTableSeeder
