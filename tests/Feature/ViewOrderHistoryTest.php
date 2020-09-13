<?php

namespace Tests\Feature;

use App\Models\Order;
use App\Models\User;
use Database\Factories\OrderFactory;
use Database\Factories\ProductFactory;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ViewOrderHistoryTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function guest_cannot_visit_this_page()
    {
        $this->get(route('orders.index'))->assertRedirect('login');
    }

    /** @test */
    public function authenticated_user_can_get_list_of_their_orders()
    {
        $this->withoutExceptionHandling();
        $jane = User::factory()->create();

        $orderForJane = Order::factory()->forUser($jane)->create();

        $orderForJohn = Order::factory()->create();

        $response = $this->actingAs($jane)->get(route('orders.index'));

        $response->assertStatus(200);

        $response->assertViewIs('orders');

        $response->assertViewHas('orders', function (Collection $orders) use ($orderForJohn, $orderForJane) {
            $this->assertTrue($orders->contains($orderForJane));
            $this->assertFalse($orders->contains($orderForJohn));
            return true;
        });
    }
}
