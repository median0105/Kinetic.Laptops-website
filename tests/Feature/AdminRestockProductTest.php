<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminRestockProductTest extends TestCase
{
    use RefreshDatabase;

    private function product(int $stock): Product
    {
        $category = Category::create([
            'name' => 'Laptop Gaming',
            'slug' => 'laptop-gaming-'.uniqid(),
            'is_active' => true,
        ]);

        return Product::create([
            'category_id' => $category->id,
            'name' => 'Test Laptop',
            'slug' => 'test-laptop-'.uniqid(),
            'sku' => 'SKU-'.uniqid(),
            'price' => 10000000,
            'stock' => $stock,
            'is_active' => true,
        ]);
    }

    public function test_admin_adds_stock_to_out_of_stock_product_and_catalog_shows_available(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $product = $this->product(0);

        $this->get(route('products.index'))
            ->assertSee('Stok habis');

        $this->actingAs($admin)
            ->post(route('admin.products.add-stock', $product), ['stock_added' => 5])
            ->assertRedirect();

        $this->assertDatabaseHas('products', ['id' => $product->id, 'stock' => 5]);

        $this->get(route('products.index'))
            ->assertSee('Stok: 5');

        $this->get(route('products.show', $product))
            ->assertSee('Stok Tersedia: 5 unit');
    }

    public function test_admin_adds_stock_to_existing_stock(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $product = $this->product(3);

        $this->actingAs($admin)
            ->post(route('admin.products.add-stock', $product), ['stock_added' => 5])
            ->assertRedirect();

        $this->assertDatabaseHas('products', ['id' => $product->id, 'stock' => 8]);
    }

    public function test_stock_add_rejected_when_quantity_is_zero(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $product = $this->product(2);

        $this->actingAs($admin)
            ->post(route('admin.products.add-stock', $product), ['stock_added' => 0])
            ->assertSessionHasErrors('stock_added');

        $this->assertDatabaseHas('products', ['id' => $product->id, 'stock' => 2]);
    }

    public function test_stock_add_forbidden_for_customer(): void
    {
        $customer = User::factory()->create(['role' => 'customer']);
        $product = $this->product(2);

        $this->actingAs($customer)
            ->post(route('admin.products.add-stock', $product), ['stock_added' => 5])
            ->assertForbidden();

        $this->assertDatabaseHas('products', ['id' => $product->id, 'stock' => 2]);
    }
}
