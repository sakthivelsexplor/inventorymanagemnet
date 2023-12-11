<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Category;

class CategoryUnitTest extends TestCase
{
    private $API_VALID_TOKEN = 'explorinventory';

    
    public function testApiTokenisvalidMiddleware()
    {
        $response = $this->postJson('/api/categories', [
            'name' => 'Test Category',
            'description' => 'Test description for category'
        ]);

        $response->assertStatus(403);
    }

    
    public function testCraeteCategoryList()
    {
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->API_VALID_TOKEN,
        ])->postJson('/api/categories', [
            'name' => 'Test Category - ' . uniqid(),
            'description' => 'Test description'
        ]);
        $response->assertStatus(201);
    }

    
    public function testUpdateCategory()
    {
        $Category = Category::orderBy('id', 'DESC')->first();
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->API_VALID_TOKEN,
        ])->putJson('/api/categories/' . $Category->id, [
            'name' => 'Test Category - ' . uniqid(),
            'description' => 'Test description'
        ]);
        $response->assertStatus(200);
    }

    
    public function testUpdateNotFoundCategory()
    {
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->API_VALID_TOKEN,
        ])->putJson('/api/categories/300000', [
            'name' => 'Test category - ' . uniqid(),
            'description' => 'Test description'
        ]);
        $response->assertStatus(404);
    }

    
    public function testGetCategoriesList()
    {
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->API_VALID_TOKEN,
        ])->getJson('/api/categories');
        $response->assertStatus(200);
    }

  
    public function testGetCategoryDetails()
    {
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->API_VALID_TOKEN,
        ])->getJson('/api/categories/2');
        $response->assertStatus(200);
    }

    public function testGetDataNotFoundCategoryDetails()
    {
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->API_VALID_TOKEN,
        ])->getJson('/api/categories/2000000');
        $response->assertStatus(404);
    }

    public function testDeleteDataNotFoundCategory()
    {
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->API_VALID_TOKEN,
        ])->delete('/api/categories/1000000');
        $response->assertStatus(400);
    }

    public function testDeleteCategory()
    {
        $Category = Category::orderBy('id', 'DESC')->first();
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->API_VALID_TOKEN,
        ])->delete('/api/categories/' . $Category->id);
        $response->assertStatus(200);
    }




}


