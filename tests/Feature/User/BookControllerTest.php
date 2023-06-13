<?php

namespace Tests\Feature\User;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BookControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_home_page()
    {
        $response = $this->get('/user/');

        $response->assertStatus(200);
    }

    public function test_show_page()
    {

        $response = $this->get('/user/show/1');

        $response->assertStatus(200);
    }
}
