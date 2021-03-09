<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CreateRoomTest extends TestCase
{
   
    use WithFaker;
    
    public function setUp(): void{
        parent::setUp();
        
        $this->setBaseRoute('room');
        $this->setBaseModel('App\Room');

    }

    /** @test */
    public function a_privilege_user_can_create_room(){
        $this->signIn();
        $this->create();
    }

    /** @test */
    public function a_unauthenticated_privilege_user_cannot_create_room(){
        $this->create();
    }

    /** @test */
    public function a_room_requires_a_number(){
        $this->signIn();
        $this->post(route('room.store'), [])->assertSessionHasErrors('number');
    }
}
