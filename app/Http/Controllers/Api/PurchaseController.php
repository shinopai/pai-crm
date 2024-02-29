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
}
