<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;

class DashboardController extends Controller
{
    public function index()
    {
        $items = Item::orderBy('id', 'desc')->limit(5)->get();

        return view('dashboard', compact('items'));
    }
}
