<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Item;
use App\Models\Category;

class ItemUnitTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

     private $API_HEADERS = [
        'Authorization' => 'Bearer explorinventory',
        'Accept' => 'application/json'
    ];

    

    public function testItemList()
    {
        $response = $this->withHeaders($this->API_HEADERS)->getJson('/api/items');
        $response->assertStatus(200);
    }

    public function testItemStore()
    {
        $Categories = Category::pluck('id');
        $response = $this->withHeaders($this->API_HEADERS)
            ->postJson('/api/items', [
                'Name' => 'Test item - ' . uniqid(),
                'Description' => 'Test description',
                'Price' => 100.00,
                'Quantity' => 07,
                'CategoryID' => $Categories
            ]);
        $response->assertStatus(201);
    }

    public function testUpdateItem()
    {
        $Item = Item::orderBy('id', 'ASC')->first();
        $Categories = Category::pluck('id')->first();
        $response = $this->withHeaders($this->API_HEADERS)
            ->put('/api/items/' . $Item->id, [
                'Name' => 'Test Item - ' . uniqid(),
                'Description' => 'Test description updated',
                'Price' => 200.00,
                'Quantity' => 501,
                'CategoryID' => [$Categories]
            ]);
        $response->assertStatus(200);
    }

    public function testUpdateNotFoundItemData()
    {
        $response = $this->withHeaders($this->API_HEADERS)
            ->put('/api/items/800000', [
            'Name' => 'Test category - ' . uniqid(),
            'Description' => 'Test description updated',
            'Price' => 200.00,
            'Quantity' => 50,
            'CategoryID' => [1]
        ]);
        $response->assertStatus(404);
    }

    public function testGetItemDetails()
    {
        $Item = Item::orderBy('id', 'DESC')->first();
        $response = $this->withHeaders($this->API_HEADERS)->getJson('/api/items/'.$Item->id);
        $response->assertStatus(200);
    }

    public function testDeleteNotFoundItem()
    {
        $response = $this->withHeaders($this->API_HEADERS)
            ->delete('/api/items/1000000');
        $response->assertStatus(400);
    }

    public function testDeleteItem()
    {
        $Item = Item::orderBy('id', 'DESC')->first();
        $response = $this->withHeaders($this->API_HEADERS)
            ->delete('/api/items/' . $Item->id);
        $response->assertStatus(200);
    }


}
