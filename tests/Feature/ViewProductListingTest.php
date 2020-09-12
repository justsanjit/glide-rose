<?php

namespace Tests\Feature;

use Database\Factories\ProductFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ViewProductListingTest extends TestCase
{
    use RefreshDatabase;
    
    /** @test */
    public function user_can_view_list_of_products()
    {
        $product = ProductFactory::new()->create();

        $response = $this->get(route('products'));

        $response->assertStatus(200);

        $response->assertViewIs('products');

        $response->assertViewHas('products', function ($items) use ($product) {
            $this->assertCount(1, $items);
            $this->assertTrue($items->first()->is($product));
            return true;
        });
    }

    /** @test */
    public function user_can_see_product_in_stock_status()
    {
        $product = ProductFactory::new()->create();

        $product->setStock(10);

        $response = $this->get(route('products'));

        $response->assertStatus(200);

        $response->assertViewHas('products', function ($items) {
            $this->assertCount(1, $items);
            $this->assertTrue($items->first()->inStock());
            return true;
        });
    }

    /** @test */
    public function user_can_see_out_of_stock_status()
    {
        $product = ProductFactory::new()->create();

        $product->setStock(0);

        $response = $this->get(route('products'));

        $response->assertStatus(200);

        $response->assertViewHas('products', function ($items) {
            $this->assertCount(1, $items);
            $this->assertTrue($items->first()->outOfStock());
            return true;
        });
    }
}
