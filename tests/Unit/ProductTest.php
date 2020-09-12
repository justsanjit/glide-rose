<?php

namespace Tests\Unit;

use App\Models\Product;
use Database\Factories\ProductFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function can_get_product_price_in_dollars()
    {
        $product = Product::factory()->make([
            'price' => 4590
        ]);

        $this->assertEquals('45.90', $product->price_in_dollars);
    }
}
