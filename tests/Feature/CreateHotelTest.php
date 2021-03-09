<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CreateHotelTest extends TestCase
{
    use WithFaker;
    
    public function setUp(): void{
        parent::setUp();
        
        $this->setBaseRoute('hotel');
        $this->setBaseModel('App\Hotel');

    }

    /** @test */
    public function a_privilege_user_can_create_hotel(){
        $this->signIn();
        $this->create();
    }

    /** @test */
    public function a_unauthenticated_privilege_user_cannot_create_hotel(){
        $this->create();
    }

    /** @test */
    public function a_hotel_requires_a_name(){
        $this->signIn();
        $this->post(route('hotel.store'), [])->assertSessionHasErrors('name');
    }
}
