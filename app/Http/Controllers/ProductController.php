<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    function products(Request $request)
    {
        $kyw = $request->input('query');
        $category_id = $request->input('category_id');

        $categories = Category::orderBy('name', 'ASC')->get();
        if ($request->category_id) {
            $products = Product::where('category_id', $request->category_id)->orderBy('id', 'desc')->paginate(12);
        } else {
            $products = Product::orderBy('id', 'desc')->paginate(12); //phan trang 9sp/1page
        }
        return view('client.home.products', compact('categories', 'products', 'kyw', 'category_id'));
    }

    function detail(Request $request) //truyen id o route vao phai co request
    {
        if ($request->product_id) {
            $sp = Product::find($request->product_id);
            $splq = Product::where('category_id', $sp->category_id)->where('id', '<>', $sp->id)->get(); //lay sp co cung id vs sp hien tai va khac id vs spht
            $categories = Category::orderBy('name', 'asc')->get();
            return view('client.detailSearch.detail', compact('sp', 'splq','categories'));
        }
    }
    function search(Request $request)
    {
        $categories = Category::orderBy('name', 'ASC')->get();

        $kyw = $request->input('query');
        $category_id = $request->input('category_id');

        // $products = Product::where('name', 'LIKE', "%$kyw%")->orWhere('description', 'LIKE', "%$kyw%")->orderBy('id', 'DESC')->paginate(9);
        $products = Product::where('name', 'LIKE', "%$kyw%")->orderBy('id', 'DESC')->paginate(9);
        // echo var_dump($dssp);
        return view('client.detailSearch.proSearch', compact('categories', 'products', 'kyw', 'category_id'));
    }
    function index()
    {
        $products = Product::all();
        return view('products.index', compact('products'));
    }

    function store(Request $request)
    {
        Product::create($request->all());
        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }

    function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    function update(Request $request, Product $product)
    {
        $product->update($request->all());
        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }

    function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }
}
