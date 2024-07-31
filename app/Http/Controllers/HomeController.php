<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    function index()
    {
        $newProducts = Product::newProducts(8)->get();
        $bestsellerProducts = Product::bestsellerProducts(6)->get();
        $instockProducts = Product::instockProducts(3)->get();
        $categories = Category::orderBy('name', 'asc')->get();
        return view('client.home.home', compact('categories', 'newProducts', 'bestsellerProducts', 'instockProducts'));
    }
    // public function header()
    // {
    //     $categories = Category::orderBy('name', 'asc')->get();
    //     return view('header', compact('categories'));
    // }
    public function productHome()
    {
        $newestProducts = Product::orderBy('created_at', 'desc')->take(6)->get();
        $bestSellingProducts = Product::orderBy('sales_count', 'desc')->take(6)->get();
        $mostViewedProducts = Product::orderBy('views_count', 'desc')->take(6)->get();

        return view('product_home', compact('newestProducts', 'bestSellingProducts', 'mostViewedProducts'));
    }
    public function summer2024()
    {
        $newProducts = Product::newProducts(6)->get();
        $bestsellerProducts = Product::bestsellerProducts(6)->get();
        $instockProducts = Product::instockProducts(3)->get();
        return view('summer2024', compact('newProducts', 'bestsellerProducts', 'instockProducts'));
    }

}
