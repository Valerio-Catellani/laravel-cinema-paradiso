<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Slot;

class SlotSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = json_decode(file_get_contents(__DIR__ . '\slotsDb.json'), true);
        foreach ($data as $slot) {
            $new_slot = new Slot();
            $new_slot->name = $slot['name'];
            $new_slot->slug = Slot::generateSlug($slot['name']);
            $new_slot->start_time = $slot['start_time'];
            $new_slot->end_time = $slot['end_time'];
            $new_slot->save();
        }
    }
}
