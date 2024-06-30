<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;


class UserController extends Controller
{
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'nullable|string|max:15|unique:users',
            'address' => 'nullable|string|max:255',
        ]);

        User::create($validated);

        return redirect()->back()->with('success', 'User registered successfully!');
    }

    public function search(Request $request)
    {
        $query = $request->query('query');
        $users = User::where('name', 'LIKE', "%{$query}%")->get(['name']);

        return response()->json($users);
    }

    public function listUsers()
    {
        $users = User::select(
            'users.id',
            'users.name',
            'users.created_at',
            DB::raw('COUNT(orders.id) as orders_count'),
            DB::raw('MAX(orders.created_at) as last_order_date')
        )
            ->leftJoin('orders', 'users.id', '=', 'orders.user_id')
            ->groupBy('users.id', 'users.name', 'users.created_at')
            ->orderBy('orders_count', 'DESC')
            ->get();

        return view('users', compact('users'));
    }
}
