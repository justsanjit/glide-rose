<?php

namespace App\Http\Controllers;

class OrderConfirmationController extends Controller
{
    public function __invoke($orderId)
    {
        $order = auth()->user()->orders()->with('product')->findOrFail($orderId);

        return view('order-confirmation', compact('order'));
    }
}
