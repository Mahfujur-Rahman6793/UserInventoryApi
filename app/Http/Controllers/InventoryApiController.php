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
        $productData = $request->all();
        foreach($productData['products'] as $productInfo) {
            $product = $user->products()->create(
                [
                    'name' => $productInfo['name'],
                    'category_id' => $productInfo['category_id']
                ]
            );
            $product->categories()->attach($productInfo['category_id']);
        }



        return response()->json(
            [
                'message' => 'Product added successfully',
                // 'product' => $productInfo,
            ]
        );
    }
}
