<?php
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use App\Models\Produit;
use App\Models\Category;
use App\Models\Rayon;

uses(RefreshDatabase::class);

beforeEach(function () {
    Category::insert(['id' => 1, 'name' => 'Default Category', 'description' => 'description']);
    Rayon::insert(['id' => 1, 'name' => 'Default Rayon', 'description' => 'description']);
});

it('can fetch all products', function () {
    Produit::insert([
        ['name' => 'Product 1', 'category_id' => 1, 'rayon_id' => 1, 'stock' => 10, 'is_promotion' => 0, 'description' => 'Desc', 'price' => 100],
        ['name' => 'Product 2', 'category_id' => 1, 'rayon_id' => 1, 'stock' => 10, 'is_promotion' => 0, 'description' => 'Desc', 'price' => 100],
    ]);
    
    $response = $this->getJson('/api/produit/list');

    $response->assertOk()->assertJsonCount(2, 'data');
});

it('can create a product', function () {
    $productData = [
        'name' => 'New Product',
        'description' => 'Product Description',
        'price' => 99.99,
        'stock' => 10,
        'category_id' => 1,
        'rayon_id' => 1,
        'is_promotion' => 0
    ];
    
    $response = $this->postJson('/api/produit/create', $productData);

    $response->assertCreated();
});

it('can update a product', function () {
    Produit::insert(['id' => 1, 'name' => 'Old Name', 'description' => 'Desc', 'price' => 10.0, 'stock' => 5, 'category_id' => 1, 'rayon_id' => 1, 'is_promotion' => 0]);
    $updatedData = ['id' => 1, 'name' => 'Updated Name', 'description' => 'Desc', 'price' => 10.0, 'stock' => 5, 'category_id' => 1, 'rayon_id' => 1, 'is_promotion' => 0];

    $response = $this->putJson("/api/produit/update/1", $updatedData);
    $response->assertOk();
});

it('can delete a product', function () {
    Produit::insert(['id' => 1, 'name' => 'Product', 'description' => 'Desc', 'price' => 10.0, 'stock' => 5, 'category_id' => 1, 'rayon_id' => 1, 'is_promotion' => 0]);

    $response = $this->deleteJson("/api/produit/1");

    $response->assertNoContent();
    $this->assertDatabaseMissing('produit', ['id' => 1]);
});