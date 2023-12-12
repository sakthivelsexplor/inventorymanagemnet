<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Category;

class CategoryUnitTest extends TestCase
{
    
    public function testApiTokenisvalidMiddleware()
    {
        $response = $this->postJson('/api/categories', [
            'Name' => 'Test Category',
            'Description' => 'Test description for category'
        ]);

        $response->assertStatus(403);
    }


    public function testCraeteCategoryList()
    {
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . env('INV_API_TOKEN','explorinventory'),
        ])->postJson('/api/categories', [
            'Name' => 'Test Category - ' . uniqid(),
            'Description' => 'Test description'
        ]);
        $response->assertStatus(201);
    }


    public function testUpdateCategory()
    {
        $Category = Category::orderBy('id', 'DESC')->first();
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' .env('INV_API_TOKEN','explorinventory'),
        ])->putJson('/api/categories/' . $Category->id, [
            'Name' => 'Test Category - ' . uniqid(),
            'Description' => 'Test description'
        ]);
        $response->assertStatus(200);
    }


    public function testUpdateNotFoundCategory()
    {
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . env('INV_API_TOKEN','explorinventory'),
        ])->putJson('/api/categories/300000', [
            'Name' => 'Test category - ' . uniqid(),
            'Description' => 'Test description'
        ]);
        $response->assertStatus(404);
    }


    public function testGetCategoriesList()
    {
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . env('INV_API_TOKEN','explorinventory'),
        ])->getJson('/api/categories');
        $response->assertStatus(200);
    }


    public function testGetCategoryDetails()
    {
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . env('INV_API_TOKEN','explorinventory'),
        ])->getJson('/api/categories/2');
        $response->assertStatus(200);
    }

    public function testGetDataNotFoundCategoryDetails()
    {
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . env('INV_API_TOKEN','explorinventory'),
        ])->getJson('/api/categories/2000000');
        $response->assertStatus(404);
    }

    public function testDeleteDataNotFoundCategory()
    {
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . env('INV_API_TOKEN','explorinventory'),
        ])->delete('/api/categories/1000000');
        $response->assertStatus(400);
    }

    public function testDeleteCategory()
    {
        $Category = Category::orderBy('id', 'DESC')->first();
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . env('INV_API_TOKEN','explorinventory'),
        ])->delete('/api/categories/' . $Category->id);
        $response->assertStatus(200);
    }
}
