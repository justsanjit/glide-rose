<?php

namespace Tests\Feature;

use App\Exceptions\InsufficientStockException;
use App\Models\Order;
use App\Models\User;
use Database\Factories\ProductFactory;
use Exception;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class PurchaseProductTest extends TestCase
{
    use RefreshDatabase;
    
    /** @test */
    public function authenticated_user_can_purchase_product()
    {
        $product = ProductFactory::new()->create([
            'price' => 3400
        ]);

        $product->setStock(10);

        $jane = User::factory()->create([
            'email' => 'jane@example.com'
        ]);

        $this->assertCount(0, $jane->orders()->get());

        $response = $this->actingAs($jane)
            ->post("products/{$product->id}/order", ['product_id' => $product->id]);

        $this->assertCount(1, $jane->orders()->get());

        $order = $jane->orders()->first();

        $response->assertRedirect(route('order-confirmation', $order));

        $this->assertEquals(3400, $order->charge);

        $this->assertTrue($order->product->is($product));

        $this->assertEquals(9, $product->stock());
    }

    /** @test */
    public function cannot_purchase_product_with_insufficient_stock()
    {
        $product = ProductFactory::new()->create([
            'price' => 3400
        ]);

        $product->setStock(0);

        $jane = User::factory()->create([
            'email' => 'jane@example.com'
        ]);

    
        $response = $this->actingAs($jane)
            ->post("products/{$product->id}/order", ['product_id' => $product->id]);

        $response->assertRedirect(route('products'));

        $response->assertSessionHas('error', 'Product out of stock.');
    }

    /** @test */
    public function return_back_with_error_if_transaction_fails()
    {
        DB::shouldReceive('transaction')->andThrow(Exception::class);

        $product = ProductFactory::new()->create([
            'price' => 3400
        ]);

        $product->setStock(10);

        $jane = User::factory()->create([
            'email' => 'jane@example.com'
        ]);
    
        $response = $this->actingAs($jane)
            ->post("products/{$product->id}/order", ['product_id' => $product->id]);

        $response->assertRedirect(route('products'));

        $response->assertSessionHas('error', 'Unable to process the request.');
    }

    /** @test */
    public function unauthenticated_user_cannot_see_confirmation_page()
    {
        $order = Order::factory()->create();

        $response = $this->get("/order-confirmation/{$order->id}");

        $response->assertRedirect(route('login'));
    }

    /** @test */
    public function authenticated_can_see_order_confirmation_page_of_their_orders()
    {
        $jane = User::factory()->create();

        $order = Order::factory()
            ->forUser($jane)
            ->create();

        $response = $this->actingAs($jane)->get("/order-confirmation/{$order->id}");
    
        $response->assertStatus(200);

        $response->assertViewIs('order-confirmation');

        $response->assertViewHas('order', function ($userOrder) use ($order) {
            $this->assertTrue($order->is($userOrder));
            return true;
        });
    }

    /** @test */
    public function authenticated_user_cannot_see_others_order_confirmation()
    {
        $jane = User::factory()->create();

        $john = User::factory()->create();

        $orderForJane = Order::factory()
            ->forUser($jane)
            ->create();

        $response = $this->actingAs($john)->get("/order-confirmation/{$orderForJane->id}");
    
        $response->assertNotFound();
    }
}
