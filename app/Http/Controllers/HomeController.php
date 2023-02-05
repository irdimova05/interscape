<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        if (auth()->user()) {
            return redirect()->route('ads.index');
        }
        return redirect()->route('login');
    }
}
