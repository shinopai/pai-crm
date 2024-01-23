<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Item;
use App\Http\Requests\ItemRequest;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = Item::orderBy('id', 'desc')->paginate(20);

        return response()->json([
            'status' => true,
            'items' => $items
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function storeItem(ItemRequest $request)
    {
        Item::create([
            'name' => $request->name,
            'price' => $request->price
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function getItem(Item $id)
    {
        $item = Item::find($id);

        return response()->json([
            'item' => $item
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateItem(ItemRequest $request, Item $id)
    {
        $item = Item::find($id);
        $item[0]->name = $request->name;
        $item[0]->price = $request->price;
        $item[0]->status = $request->status;
        $item[0]->update();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroyItem(Item $id)
    {
        $item = Item::find($id);

        $item[0]->delete();
    }
}
