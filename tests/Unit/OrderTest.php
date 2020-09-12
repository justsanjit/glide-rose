<?php

namespace Tests\Unit;

use App\Models\Order;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class OrderTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function can_get_order_charge_in_dollars()
    {
        $order = Order::factory()->make([
            'charge' => 4590
        ]);

        $this->assertEquals('45.90', $order->charge_in_dollars);
    }
}
