<?php

namespace Database\Seeders;

use App\Models\Hotel;
use App\Models\Room;
use Database\Factories\RoomFactory;
use Illuminate\Database\Seeder;

class HotelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Hotel::factory()
        ->count(100)
        ->has(Room::factory()->count(random_int(1,100)))
        ->create();
    }
}
