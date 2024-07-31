<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    function contact()
    {
        $categories = Category::orderBy('name', 'asc')->get();
        return view('client.home.contact', compact('categories'));
    }
}
