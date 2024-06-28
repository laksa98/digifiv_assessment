<?php

namespace Tests\Unit;

// use PHPUnit\Framework\TestCase;
use App\Models\Ingredient;
use SebastianBergmann\Type\VoidType;
use Tests\TestCase;

class IngredientTest extends TestCase
{
    /**
     * A basic unit test example.
     */

    public function test_get_ingredient(): void
    {
        $ingredient = Ingredient::factory()->count(3)->create();   

        $response = $this->get('/api/ingredients');

        $response->dump();

        $response->assertStatus(200);
    }

    public function test_show_ingredient(): void
    {
        $ingredient = Ingredient::factory()->create([
            'name' => 'Test ingredient show',
        ]);

        $response = $this->get('/api/ingredients/' . $ingredient->id);

        $response->dump();

        $response->assertStatus(200);
    }
    
    public function test_create_ingredient(): void
    {
        $response = $this->post('/api/ingredients', [
            'name' => 'test ingredient 3',
        ]);

        $response->dump();

        $response->assertStatus(201);

    }

    public function test_update_ingredient(): void
    {
        $ingredient = Ingredient::factory()->create([
            'name' => 'test ingredient',
        ]);

        $response = $this->put('/api/ingredients/' . $ingredient->id, [
            'name' => 'test ingredient 4',
        ]);

        $response->dump();

        $response->assertStatus(200);
    }

    public function test_delete_ingredient(): void
    {
        $ingredient = Ingredient::factory()->create([
            'name' => 'test ingredient delete',
        ]);

        $response = $this->delete('/api/ingredients/'. $ingredient->id);

        $response->dump();

        $response->assertStatus(204);
    }

}
