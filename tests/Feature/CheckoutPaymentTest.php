<?php

namespace Tests\Feature;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use App\Services\MidtransService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CheckoutPaymentTest extends TestCase
{
    use RefreshDatabase;

    private function customerWithCart(): array
    {
        $user = User::factory()->create(['role' => 'customer']);
        $category = Category::create(['name' => 'Laptop Gaming', 'slug' => 'laptop-gaming', 'is_active' => true]);
        $product = Product::create([
            'category_id' => $category->id,
            'name' => 'Test Laptop',
            'slug' => 'test-laptop',
            'sku' => 'SKU-0001',
            'price' => 10000000,
            'stock' => 5,
            'is_active' => true,
        ]);
        $cart = Cart::create(['user_id' => $user->id]);
        $cart->items()->create(['product_id' => $product->id, 'quantity' => 2, 'price' => $product->price]);

        return [$user, $product, $cart];
    }

    public function test_checkout_page_redirects_to_cart_when_empty(): void
    {
        $user = User::factory()->create(['role' => 'customer']);

        $this->actingAs($user)
            ->get(route('checkout.create'))
            ->assertRedirect(route('cart.index'));
    }

    public function test_checkout_store_blocks_when_midtrans_not_configured(): void
    {
        config()->set('services.midtrans.server_key', null);
        config()->set('services.midtrans.client_key', null);

        [$user] = $this->customerWithCart();

        $this->actingAs($user)
            ->post(route('checkout.store'), $this->validAddress())
            ->assertSessionHasErrors('payment');
    }

    public function test_checkout_creates_order_and_snap_token(): void
    {
        config()->set('services.midtrans.server_key', 'SB-Mid-server-test');
        config()->set('services.midtrans.client_key', 'SB-Mid-client-test');

        [$user, $product, $cart] = $this->customerWithCart();

        $this->mock(MidtransService::class, function ($mock) {
            $mock->shouldReceive('isConfigured')->andReturn(true);
            $mock->shouldReceive('createSnapToken')->andReturn('snap-token-123');
        });

        $response = $this->actingAs($user)
            ->post(route('checkout.store'), $this->validAddress());

        $response->assertRedirect();

        $this->assertDatabaseHas('orders', [
            'user_id' => $user->id,
            'payment_token' => 'snap-token-123',
            'payment_status' => 'pending',
            'order_status' => 'pending',
            'total_amount' => 20000000,
        ]);

        $this->assertDatabaseHas('order_items', [
            'product_id' => $product->id,
            'quantity' => 2,
            'subtotal' => 20000000,
        ]);

        $this->assertDatabaseMissing('cart_items', ['cart_id' => $cart->id]);
        $this->assertDatabaseHas('products', ['id' => $product->id, 'stock' => 3]);
    }

    public function test_buy_now_replaces_cart_and_redirects_to_checkout(): void
    {
        [$user, $product, $cart] = $this->customerWithCart();

        $other = Product::create([
            'category_id' => $cart->items->first()->product->category_id,
            'name' => 'Lain',
            'slug' => 'lain',
            'sku' => 'SKU-LAIN',
            'price' => 5000,
            'stock' => 10,
            'is_active' => true,
        ]);

        $this->actingAs($user)
            ->post(route('cart.items.store'), [
                'product_id' => $other->id,
                'quantity' => 3,
                'action' => 'buy_now',
            ])
            ->assertRedirect(route('checkout.create'));

        $this->assertDatabaseHas('cart_items', [
            'cart_id' => $cart->id,
            'product_id' => $other->id,
            'quantity' => 3,
        ]);
        $this->assertDatabaseMissing('cart_items', ['cart_id' => $cart->id, 'product_id' => $product->id]);
    }

    public function test_payment_success_marks_order_paid_and_shipped(): void
    {
        config()->set('services.midtrans.server_key', 'SB-Mid-server-test');
        config()->set('services.midtrans.client_key', 'SB-Mid-client-test');

        $user = User::factory()->create(['role' => 'customer']);
        $order = Order::create([
            'user_id' => $user->id,
            'order_number' => 'LAP-TEST-1',
            'subtotal' => 10000,
            'shipping_cost' => 0,
            'total_amount' => 10000,
            'payment_method' => 'midtrans',
            'payment_status' => 'pending',
            'order_status' => 'pending',
            'recipient_name' => 'Budi',
            'phone' => '0812',
            'shipping_address' => 'Jl. A',
            'city' => 'Jakarta',
            'province' => 'DKI',
            'postal_code' => '10110',
        ]);

        \Mockery::mock('alias:Midtrans\\Transaction')
            ->shouldReceive('status')
            ->once()
            ->andReturn((object) ['transaction_status' => 'settlement', 'transaction_id' => 'txn-123']);

        $this->actingAs($user)
            ->postJson(route('orders.payment-success', $order))
            ->assertOk()
            ->assertJson(['success' => true]);

        $this->assertDatabaseHas('orders', [
            'id' => $order->id,
            'payment_status' => 'paid',
            'order_status' => 'shipped',
            'midtrans_transaction_id' => 'txn-123',
        ]);
    }

    public function test_payment_success_rejects_when_transaction_not_settled(): void
    {
        config()->set('services.midtrans.server_key', 'SB-Mid-server-test');
        config()->set('services.midtrans.client_key', 'SB-Mid-client-test');

        $user = User::factory()->create(['role' => 'customer']);
        $order = Order::create([
            'user_id' => $user->id,
            'order_number' => 'LAP-TEST-2',
            'subtotal' => 10000,
            'shipping_cost' => 0,
            'total_amount' => 10000,
            'payment_method' => 'midtrans',
            'payment_status' => 'pending',
            'order_status' => 'pending',
            'recipient_name' => 'Budi',
            'phone' => '0812',
            'shipping_address' => 'Jl. A',
            'city' => 'Jakarta',
            'province' => 'DKI',
            'postal_code' => '10110',
        ]);

        \Mockery::mock('alias:Midtrans\\Transaction')
            ->shouldReceive('status')
            ->once()
            ->andReturn((object) ['transaction_status' => 'pending']);

        $this->actingAs($user)
            ->postJson(route('orders.payment-success', $order))
            ->assertStatus(422)
            ->assertJson(['success' => false]);

        $this->assertDatabaseHas('orders', ['id' => $order->id, 'payment_status' => 'pending', 'order_status' => 'pending']);
    }

    public function test_payment_success_forbidden_for_other_users(): void
    {
        $owner = User::factory()->create(['role' => 'customer']);
        $other = User::factory()->create(['role' => 'customer']);
        $order = Order::create([
            'user_id' => $owner->id,
            'order_number' => 'LAP-TEST-3',
            'subtotal' => 10000,
            'shipping_cost' => 0,
            'total_amount' => 10000,
            'payment_method' => 'midtrans',
            'payment_status' => 'pending',
            'order_status' => 'pending',
            'recipient_name' => 'Budi',
            'phone' => '0812',
            'shipping_address' => 'Jl. A',
            'city' => 'Jakarta',
            'province' => 'DKI',
            'postal_code' => '10110',
        ]);

        $this->actingAs($other)
            ->postJson(route('orders.payment-success', $order))
            ->assertForbidden();
    }

    private function validAddress(): array
    {
        return [
            'recipient_name' => 'Budi',
            'phone' => '081234567890',
            'shipping_address' => 'Jl. Merdeka No. 1',
            'city' => 'Jakarta',
            'province' => 'DKI Jakarta',
            'postal_code' => '10110',
        ];
    }
}
