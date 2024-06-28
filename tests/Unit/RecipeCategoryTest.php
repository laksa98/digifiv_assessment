<?php

namespace Tests\Unit;

// use PHPUnit\Framework\TestCase;
use Tests\TestCase;
use App\Models\Recipe;
use App\Models\Category;
use App\Models\Chef;


class RecipeCategoryTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function test_create_recipeCategory(): void
    {
        $chef = Chef::factory()->create([
            'name' => 'Test chef create',
        ]);

        $recipe = Recipe::factory()->create([
            'name' => 'Test recipe show',
            'chef_id' => $chef->id,
            'unique_code' => $this->generateRandomLetters(),
        ]);

        $category = Category::factory()->create([
            'name' => 'Test Category create',
        ]);

        $response = $this->post('/api/recipeCategories', [
            'recipe_id' => [$recipe->id],
            'category_id' => $category->id,
        ]);

        $response->dump();

        $response->assertStatus(201);
    }

    public function test_get_recipeCategory(): void
    {
        $response = $this->get('/api/recipeCategories');

        $response->dump();

        $response->assertStatus(200);
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
