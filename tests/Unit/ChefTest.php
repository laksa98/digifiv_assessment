<?php

namespace Tests\Unit;

// use PHPUnit\Framework\TestCase;
use SebastianBergmann\Type\VoidType;
use Tests\TestCase;
use App\Models\Chef;


class ChefTest extends TestCase
{
    /**
     * A basic unit test example.
     */

    public function test_get_chef(): Void
    {
        $chef = Chef::factory()->count(3)->create();

        $response = $this->get('/api/chefs');

        $response->dump();

        $response->assertStatus(200);
    }

    public function test_show_chef(): void
    {
        $chef = Chef::factory()->create([
            'name' => 'Test chef show',
        ]);

        $response = $this->get('/api/chefs/' . $chef->id);

        $response->dump();

        $response->assertStatus(200);
    }

    public function test_create_chef(): void
    {
        $response = $this->post('/api/chefs', [
            'name' => 'test chef 1',
            'signature_dishes' => 'meat',
        ]);

        $response->dump();

        $response->assertStatus(201);
    }

    public function test_update_chef(): void
    {
        $chef = Chef::factory()->create([
            'name' => 'Old Chef',
            'signature_dishes' => 'water',
        ]);

        $response = $this->put('/api/chefs/' . $chef->id, [
            'name' => 'new chef ',
            'signature_dishes' => 'meat',
        ]);

        $response->dump();

        $response->assertStatus(200);
    }

    public function test_delete_chef(): void
    {
        $chef = Chef::factory()->create([
            'name' => 'to delete Chef',
            'signature_dishes' => 'water',
        ]);

        $response = $this->delete('/api/chefs/' . $chef->id);

        $response->dump();

        $response->assertStatus(204);
    }
}
