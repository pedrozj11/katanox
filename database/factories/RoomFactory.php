<?php

namespace Database\Factories;

use App\Models\Hotel;
use App\Models\Room;
use Illuminate\Database\Eloquent\Factories\Factory;

class RoomFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Room::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'number'=> $this->faker->unique()->randomNumber(5),
            'beds'=> $this->faker->numberBetween(1,4),
            'price'=> $this->faker->numberBetween(1, 100),
            'hotel_id'=> Hotel::factory(),
        ];
    }
}
