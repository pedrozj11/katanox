<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DeleteRoomTest extends TestCase
{
    use WithFaker;
    
    public function setUp(): void{
        parent::setUp();
        
        $this->setBaseRoute('room');
        $this->setBaseModel('App\Room');

    }

    /** @test */
    public function a_privilege_user_can_delete_room(){
        $this->signIn();
        $this->destroy()->assertStatus(204);
    }

    /** @test */
    public function a_unauthenticated_privilege_user_cannot_delete_room(){
        $this->destroy()->assertStatus(204);
    }

    /** @test */
    public function a_user_can_delete_multiple_room(){
        $this->signIn();
        $this->multipleDelete()->assertStatus(204);
    }
}
