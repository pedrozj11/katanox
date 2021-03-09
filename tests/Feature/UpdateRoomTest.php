<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UpdateRoomTest extends TestCase
{
    use WithFaker;
    
    public function setUp(): void{
        parent::setUp();
        
        $this->setBaseRoute('room');
        $this->setBaseModel('App\Room');
        
        $this->attributes = [
            'name' => $this->faker->name(),
            'address' => $this->faker->address(),
            'phone' => $this->faker->phoneNumber(),
            'city' => $this->faker->city(),
            'stars' => $this->faker->numberBetween(1,5),
        ];
    }

    /** @test */
    public function a_privilege_user_can_update_room(){
        $this->signIn();
        $this->update($this->attributes);
    }

    /** @test */
    public function a_unauthenticated_privilege_user_cannot_update_room(){
        $this->update($this->attributes);
    }
}
