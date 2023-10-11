<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class AdminAccessTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    // public function test_example(): void
    // {
    //     $response = $this->get('/');

    //     $response->assertStatus(200);
    // }

    public function testAdminCanAccessAdminEndpoints()
    {
        // Buat pengguna sebagai admin
        $admin = User::factory()->create(['role' => 'admin']);

        // Autentikasi pengguna sebagai admin
        $this->actingAs($admin);

        // Coba akses endpoint create, update, dan delete
        $response = $this->get('/news');
        $response->assertStatus(200); // Gantilah sesuai dengan respons yang diharapkan

        $response = $this->get('/news');
        $response->assertStatus(200); // Gantilah sesuai dengan respons yang diharapkan

        // Anda dapat melanjutkan dengan menguji endpoint lain

        // Pastikan logout pengguna setelah selesai menguji
        $this->actingAs(null);
    }

    public function testNonAdminCannotAccessAdminEndpoints()
    {
        // Buat pengguna biasa (non-admin)
        $user = User::factory()->create(['role' => 'user']);

        // Autentikasi pengguna sebagai non-admin
        $this->actingAs($user);

        // Coba akses endpoint create, update, dan delete
        $response = $this->get('/news');
        $response->assertStatus(403); // Harapkan respons Forbidden (403)

        $response = $this->get('/news');
        $response->assertStatus(403); // Harapkan respons Forbidden (403)

        // Anda dapat melanjutkan dengan menguji endpoint lain

        // Pastikan logout pengguna setelah selesai menguji
        $this->actingAs(null);
    }

}
