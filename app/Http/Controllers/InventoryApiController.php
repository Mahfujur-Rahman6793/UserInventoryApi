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
    public function productAdd(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $product = $user->products()->create(
            [
                'name' => $request->input('name'),
                'category_id' => $request->input('category_id')
            ]
        );
        $product->categories()->attach($request->input('category_id'));

        return response()->json(
            [
                'message' => 'Product added successfully',
                'product' => $product,
            ]
        );
    }
}
