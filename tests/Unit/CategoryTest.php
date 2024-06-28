<?php

namespace Tests\Unit;

// use PHPUnit\Framework\TestCase;
use Tests\TestCase;
use App\Models\Category;


class CategoryTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function test_get_category(): void
    {
        $categories = Category::factory()->count(3)->create();

        $response = $this->get('/api/categories');

        $response->dump();

        $response->assertStatus(200);
    }

    public function test_show_category(): void
    {
        $category = Category::factory()->create([
            'name' => 'Test Category',
        ]);

        $response = $this->get('/api/categories/' . $category->id);

        $response->dump();

        $response->assertStatus(200);
    }

    public function test_create_category(): void
    {
        $response = $this->post('/api/categories', [
            'name' => 'test category',
        ]);

        $response->dump();

        $response->assertStatus(201);
    }

    public function test_update_category(): void
    {
        $category = Category::factory()->create([
            'name' => 'Old Name',
        ]);

        $response = $this->put('/api/categories/' . $category->id, [
            'name' => 'Updated name',
        ]);

        $response->dump();

        $response->assertStatus(200);
    }

    public function test_delete_category(): void
    {
        $category = Category::factory()->create([
            'name' => 'Category to be deleted',
        ]);

        $response = $this->delete('/api/categories/' . $category->id);

        $response->dump();

        $response->assertStatus(204);
    }
}
