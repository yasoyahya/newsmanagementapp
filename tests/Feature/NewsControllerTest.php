<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class NewsControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     */

    // public function test_example(): void
    // {
    //     $response = $this->get('/');

    //     $response->assertStatus(200);
    // }

    public function testIndex()
    {
    // Menjalankan request ke endpoint /berita (sesuaikan dengan route Anda)
    $response = $this->get('/news');

    // Memastikan respons HTTP adalah 200 OK
    $response->assertStatus(200);

    // Memeriksa apakah respons berisi data JSON yang sesuai
    $response->assertJson(['success']); // Gantilah dengan hasil yang diharapkan
    }

}
