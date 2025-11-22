<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Order;
use App\Models\User;

class OrderController extends Controller
{
    // Return a JSON list of vendors (users with role 'vendor')
    public function vendors()
    {
        $vendors = User::where('role', 'vendor')->get(['id', 'name', 'store_name']);
        return response()->json($vendors);
    }

    // Demo products per vendor (replace with real product lookup if available)
    public function products($vendorId)
    {
        // Query real products by vendor if the products table exists; fallback to empty array
        if (class_exists('\App\\Models\\Product')) {
            $prods = \App\Models\Product::where('vendor_id', $vendorId)->get(['id', 'name', 'price']);
            return response()->json($prods);
        }

        return response()->json([]);
    }

    // Store a new order
    public function store(Request $request)
    {
        $data = $request->validate([
            'vendor_name' => 'required|string|max:255',
            'product_id' => 'nullable|integer',
            'product_name' => 'required|string|max:255',
            'quantity' => 'required|integer|min:1',
            'estimated_delivery' => 'nullable|date',
        ]);

        // determine price from product_id if provided
        $price = 0;
        if (!empty($data['product_id']) && class_exists('\App\\Models\\Product')) {
            $prod = \App\Models\Product::find($data['product_id']);
            if ($prod) $price = (float) $prod->price;
        }

        $orderNumber = 'ORD' . date('YmdHis') . rand(100, 999);

        $order = Order::create([
            'order_number' => $orderNumber,
            'user_id' => Auth::id(),
            'vendor_name' => $data['vendor_name'],
            'product_name' => $data['product_name'],
            'quantity' => $data['quantity'],
            'total_price' => $price * $data['quantity'],
            'status' => 'pending',
            'estimated_delivery' => $data['estimated_delivery'] ?? null,
        ]);

        return response()->json(['success' => true, 'order' => $order]);
    }
}
