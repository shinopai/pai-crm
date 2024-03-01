<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Item;
use App\Models\CustomerItem;
use App\Http\Requests\CustomerItemRequest;

class PurchaseController extends Controller
{
    public function index()
    {
        $purchases = CustomerItem::orderBy('id', 'desc')->paginate(20);
        $customers = array();
        $items = array();

        // 購入履歴テーブルに紐づいている顧客情報を取得
        foreach ($purchases as $purchase) {
            array_push($customers, Customer::find($purchase->customer_id, ['id', 'name']));
        }

        // 購入履歴テーブルに紐づいている商品情報を取得
        foreach ($purchases as $purchase) {
            array_push($items, Item::find($purchase->item_id, ['id', 'name', 'price']));
        }

        return response()->json([
            'status' => true,
            'purchases' => $purchases,
            'customers' => $customers,
            'items' => $items
        ]);
    }

    public function storePurchase(CustomerItemRequest $request)
    {
        $item = Item::find($request->item_id);
        $customer = Customer::find($request->customer_id);

        $customer->items()->attach(
            $item['id'],
            ['quantity' => $request->quantity,
             'purchase_datetime' => $request->purchase_datetime
            ]
        );
    }

    public function getPurchase(CustomerItem $purchase)
    {
        $customer = Customer::find($purchase->customer_id, ['name']);
        $item = Item::find($purchase->item_id, ['name', 'price']);

        return response()->json([
            'purchase' => $purchase,
            'customer' => $customer,
            'item' => $item
        ]);
    }
}
