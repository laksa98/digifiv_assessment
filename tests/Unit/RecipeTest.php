<?php

namespace Tests\Unit;

// use PHPUnit\Framework\TestCase;
use App\Models\Recipe;
use Tests\TestCase;
use App\Models\Chef;
use App\Models\Ingredient;



class RecipeTest extends TestCase
{
    /**
     * A basic unit test example.
     */

    public function test_get_recipe(): Void
    {
        $recipe = Recipe::factory()->count(3)->create();

        $response = $this->get('/api/recipes');

        $response->dump();

        $response->assertStatus(200);
    }

    public function test_show_recipe(): void
    {
        $chef = Chef::factory()->create([
            'name' => 'Test chef show recipe',
        ]);

        $recipe = Recipe::factory()->create([
            'name' => 'Test recipe show',
            'chef_id' => $chef->id,
            'unique_code' => $this->generateRandomLetters(),
        ]);

        $response = $this->get('/api/recipes/' . $recipe->id);

        $response->dump();

        $response->assertStatus(200);
    } 

    public function test_create_recipe(): void
    {
        $chef = Chef::factory()->create([
            'name' => 'Test chef create recipe',
        ]);

        $response = $this->post('/api/recipes', [
            'name' => 'test recipe 3 create',
            'chef_id' => $chef->id,
            'unique_code' => $this->generateRandomLetters(),
        ]);

        $response->dump();

        $response->assertStatus(201);

    }

    public function test_update_recipe(): void
    {
        $chef = Chef::factory()->create([
            'name'=> 'Test chef show recipe',
        ]);

        $recipe = Recipe::factory()->create([
            'name' => 'test recipe 3 update',
            'chef_id' => $chef->id,
            'unique_code' => $this->generateRandomLetters(),
        ]);

        $response = $this->put('/api/recipes/' . $recipe->id, [
            'name' => 'test recipe 99 update',
            'chef_id' => $chef->id,
            'unique_code' => $this->generateRandomLetters(),
        ]);

        $response->dump();

        $response->assertStatus(200);
    }

    public function test_delete_recipe(): void
    {
        $chef = Chef::factory()->create([
            'name'=> 'Test chef delete recipe',
        ]);

        $recipe = Recipe::factory()->create([
            'name' => 'test recipe 100 delete',
            'chef_id' => $chef->id,
            'unique_code' => $this->generateRandomLetters(),
        ]);

        $response = $this->delete('/api/recipes/'. $recipe->id);

        $response->dump();

        $response->assertStatus(204);
    }

    public function test_save_recipeIngredient(): void
    {
        $chef = Chef::factory()->create([
            'name'=> 'Test chef save recipe ingredient',
        ]);

        $ingredient = Ingredient::factory()->create([
            'name' => 'Test ingredient show',
        ]);

        $recipe = Recipe::factory()->create([
            'name' => 'test 100 save recipe ingredient',
            'chef_id' => $chef->id,
            'unique_code' => $this->generateRandomLetters(),
        ]);

        $response = $this->post('/api/recipes/'. $recipe->id .'/ingredients', [
            'ingredient_id' => [$ingredient->id],
        ]);

        $response->dump();

        $response->assertStatus(201);
    }

    function generateRandomLetters() {
        $letters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
        $randomString = '';
        
        for ($i = 0; $i < 10; $i++) {
            $randomString .= $letters[rand(0, strlen($letters) - 1)];
        }
        
        return $randomString;
    }
}
