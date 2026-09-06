<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class AdminPanelTest extends TestCase
{
    use RefreshDatabase;

    private function admin(): User
    {
        return User::factory()->create(['role' => 'admin']);
    }

    private function customer(): User
    {
        return User::factory()->create(['role' => 'customer']);
    }

    public function test_admin_can_access_admin_dashboard(): void
    {
        $response = $this->actingAs($this->admin())
            ->get(route('admin.dashboard'));

        $response->assertOk()
            ->assertSee('Admin Dashboard')
            ->assertSee('Produk')
            ->assertSee('Kategori')
            ->assertSee('Pesanan');
    }

    public function test_admin_dashboard_has_no_shopping_links(): void
    {
        $response = $this->actingAs($this->admin())
            ->get(route('admin.dashboard'));

        $response->assertOk();
        $this->assertStringNotContainsString('>Katalog<', $response->getContent());
        $this->assertStringNotContainsString('>Keranjang<', $response->getContent());
    }

    public function test_admin_can_access_manage_products(): void
    {
        $this->actingAs($this->admin())
            ->get(route('admin.products.index'))
            ->assertOk()
            ->assertSee('Kelola Produk');
    }

    public function test_admin_can_access_manage_categories(): void
    {
        $this->actingAs($this->admin())
            ->get(route('admin.categories.index'))
            ->assertOk()
            ->assertSee('Kelola Kategori');
    }

    public function test_admin_can_access_manage_orders(): void
    {
        $this->actingAs($this->admin())
            ->get(route('admin.orders.index'))
            ->assertOk()
            ->assertSee('Kelola Pesanan');
    }

    public function test_admin_is_redirected_from_shopping_routes(): void
    {
        $this->actingAs($this->admin())
            ->get(route('cart.index'))
            ->assertRedirect(route('admin.dashboard'));

        $this->actingAs($this->admin())
            ->get(route('orders.index'))
            ->assertRedirect(route('admin.dashboard'));
    }

    public function test_customer_sees_storefront_nav_not_admin_nav(): void
    {
        $response = $this->actingAs($this->customer())
            ->get(route('dashboard'))
            ->assertOk();

        $this->assertStringNotContainsString('>Kelola Produk<', $response->getContent());
    }

    public function test_admin_can_create_product_with_image_that_appears_in_catalog(): void
    {
        Storage::fake('public');
        $category = Category::create(['name' => 'Laptop Gaming', 'slug' => 'laptop-gaming', 'is_active' => true]);

        $this->actingAs($this->admin())
            ->post(route('admin.products.store'), [
                'category_id' => $category->id,
                'name' => 'Laptop Test Gambar',
                'sku' => 'TEST-IMG-1',
                'price' => 100000,
                'stock' => 5,
                'is_featured' => true,
                'image' => UploadedFile::fake()->image('laptop.jpg', 800, 600),
            ])
            ->assertRedirect(route('admin.products.index'));

        $product = Product::where('sku', 'TEST-IMG-1')->firstOrFail();

        $this->assertNotNull($product->thumbnail);
        Storage::disk('public')->assertExists($product->thumbnail);
        $this->assertNotNull($product->thumbnailUrl());

        $catalog = $this->get(route('products.index'))->assertOk();
        $this->assertStringContainsString(asset('storage/'.$product->thumbnail), $catalog->getContent());

        $detail = $this->get(route('products.show', $product))->assertOk();
        $this->assertStringContainsString(asset('storage/'.$product->thumbnail), $detail->getContent());
    }

    public function test_admin_product_image_upload_rejects_non_image_file(): void
    {
        Storage::fake('public');
        $category = Category::create(['name' => 'Laptop Gaming', 'slug' => 'laptop-gaming', 'is_active' => true]);

        $this->actingAs($this->admin())
            ->post(route('admin.products.store'), [
                'category_id' => $category->id,
                'name' => 'Laptop Tanpa Gambar',
                'sku' => 'TEST-IMG-2',
                'price' => 100000,
                'stock' => 5,
                'image' => UploadedFile::fake()->create('dokumen.txt', 100),
            ])
            ->assertSessionHasErrors('image');

        $this->assertDatabaseMissing('products', ['sku' => 'TEST-IMG-2']);
    }

    public function test_admin_can_replace_product_image_on_update(): void
    {
        Storage::fake('public');
        $category = Category::create(['name' => 'Laptop Gaming', 'slug' => 'laptop-gaming', 'is_active' => true]);
        $product = Product::create([
            'category_id' => $category->id,
            'name' => 'Laptop Update Gambar',
            'slug' => 'laptop-update-gambar',
            'sku' => 'TEST-IMG-3',
            'price' => 100000,
            'stock' => 5,
            'thumbnail' => 'products/old-image.jpg',
        ]);

        $this->actingAs($this->admin())
            ->put(route('admin.products.update', $product), [
                'category_id' => $category->id,
                'name' => 'Laptop Update Gambar',
                'sku' => 'TEST-IMG-3',
                'price' => 110000,
                'stock' => 4,
                'image' => UploadedFile::fake()->image('new-laptop.jpg', 800, 600),
            ])
            ->assertRedirect(route('admin.products.index'));

        $product->refresh();

        $this->assertNotEquals('products/old-image.jpg', $product->thumbnail);
        Storage::disk('public')->assertExists($product->thumbnail);
        Storage::disk('public')->assertMissing('products/old-image.jpg');
    }
}
