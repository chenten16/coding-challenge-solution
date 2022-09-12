<?php

namespace Tests\Feature;

use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ProductCreationTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_productCreation()
    {

        Storage::fake('public');

        //creating a category just for testing purpose
        $category = Category::firstOrCreate(['name' => 'category']);

        $response = $this->json('POST', '/api/products/create', [
            'image' => UploadedFile::fake()->create('avatar.jpg', 100),
            'description' => 'Description',
            'price' => 12,
            'name' => 'product4',
            'categories' => [$category->id]
        ])->assertStatus(200);
    }
}
