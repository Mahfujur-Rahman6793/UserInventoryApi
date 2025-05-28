<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class InventoryApiController extends Controller
{
    public function index($id)
    {
        $user = User::findOrFail($id);
        $products = $user->products()->count();
        $catgories = $user->products()->with('categories')->get()->pluck('name')->flatten()->unique();

        return response()->json(
            [
                'message' => 'Inventory data retrieved successfully',
                'user_id' => $user->id,
                'products_count' => $products,
                'categories' => $catgories,

            ]
        );
    }
}
