<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Http\Requests\CustomerRequest;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::orderBy('id', 'desc')->paginate(20);

        return response()->json([
            'status' => true,
            'customers' => $customers
        ]);
    }

    public function searchCustomer(Request $request)
    {
        $search_word = $request->search_word;

        $q = Customer::query();

        // 顧客名と電話番号で検索
        $customers = $q->where('name', 'LIKE', '%' . $search_word . '%')->orWhere('tel', 'LIKE', '%' . $search_word . '%')->paginate(20);

        return response()->json([
            'customers' => $customers
        ]);
    }

    public function storeCustomer(CustomerRequest $request)
    {
        Customer::create([
            'name' => $request->name,
            'tel' => $request->tel,
            'email' => $request->email,
            'postcode' => $request->postcode,
            'address' => $request->address,
            'birthday' => $request->birthday,
            'gender' => $request->gender,
            'memo' => $request->memo
        ]);
    }
}
