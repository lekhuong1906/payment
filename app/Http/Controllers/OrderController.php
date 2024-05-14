<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    public function create(OrderRequest $request)
    {
        $totalAmount = 0;

        foreach ($request->products as $product) {
            $totalAmount += $product['quantity'] * $product['unit_price'];
        }

        $orderData = $request->all();
        $orderData['total_amount'] = $totalAmount;

        $order = Order::create($orderData);
        return response()->json($order, 201);
    }

    public function show($id)
    {
        $order = Order::find($id);

        if (!$order) {
            return response()->json(['message' => 'Order not found'], 404);
        }

        return response()->json($order);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            
        ]);

        $order = Order::find($id);

        if (!$order) {
            return response()->json(['message' => 'Order not found'], 404);
        }

        $orderData = $request->all();

        if (isset($orderData['products'])) {
            $totalAmount = 0;
            foreach ($orderData['products'] as $product) {
                $totalAmount += $product['quantity'] * $product['unit_price'];
            }
            $orderData['total_amount'] = $totalAmount;
        }

        $order->update($orderData);

        return response()->json($order);
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|integer|in:0,1,2',
        ]);

        $order = Order::find($id);

        if (!$order) {
            return response()->json(['message' => 'Order not found'], 404);
        }

        $order->status = $request->status;
        $order->save();

        return response()->json($order);
    }

}
