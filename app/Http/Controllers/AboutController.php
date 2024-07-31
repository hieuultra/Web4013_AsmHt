<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class AboutController extends Controller
{
    function about()
    {
        $categories = Category::orderBy('name', 'asc')->get();
        return view('client.home.about', compact('categories'));
    }
}
