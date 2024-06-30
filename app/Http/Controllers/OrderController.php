<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_name' => 'required|string',
            'order_detail' => 'required|string',
        ]);

        $user = User::where('name', $validated['user_name'])->first();

        if ($user) {
            Order::create([
                'user_id' => $user->id,
                'detail' => $validated['order_detail'],
            ]);

            return redirect()->back()->with('success', 'Order placed successfully!');
        } else {
            return redirect()->back()->with('error', 'User not found!');
        }
    }
}
