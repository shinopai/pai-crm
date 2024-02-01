<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class IndexController extends Controller
{
    public function index()
    {
        // ログイン済の場合は、ダッシュボードに遷移
        if(Auth::check()) {
            return redirect('dashboard');
        } else {
            return view('welcome');
        }
    }
}
