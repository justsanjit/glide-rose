<?php

namespace App\Http\Controllers;

use App\Exceptions\InsufficientStockException;
use App\Models\Product;
use Exception;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function store(Product $product, Request $request)
    {
        try {
            $order =  $request->user()->purchase($product);
        
            return redirect()->route('order-confirmation', $order);
        } catch (InsufficientStockException $e) {
            return back()->with('error', 'Product out of stock.');
        } catch (Exception $e) {
            return back()->with('error', 'Unable to process the request.');
        }
    }

    public function index(Request $request)
    {
        $orders = $request->user()->orders()->latest()->get();

        return view('orders', compact('orders'));
    }
}
