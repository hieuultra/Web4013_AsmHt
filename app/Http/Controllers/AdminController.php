<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }
    public function productList()
    {
        $categories = Category::orderBy('name', 'ASC')->get();
        $products = Product::orderBy('id', 'desc')->paginate(10);
        return view('admin.products.productList', compact('categories', 'products'));
    }

    public function viewProAdd(){
        $categories = Category::orderBy('name', 'asc')->get();
        return view('admin.products.viewProAdd', compact('categories'));
    }
    public function productAdd(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'img' => 'required|file|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description' => 'nullable|string',
            'content' => 'nullable|string',
            'price' => 'required|numeric',
            'quantity' => 'required|numeric',
            'discount' => 'required|numeric',
            'category_id' => 'required|integer|exists:categories,id',
        ]);

        if ($request->hasFile('img')) {
            $imageName = time() . '.' . $request->img->extension(); //Tạo tên tệp tin duy nhất dựa trên thời gian hiện tại.
            //$request->img->extension() sẽ trả về jpg,..., là phần mở rộng của tệp tin.
            $request->img->move(public_path('upload'), $imageName); //Di chuyển tệp tin đến thư mục public/upload.
            $validatedData['img'] = $imageName; //Cập nhật dữ liệu đã xác thực với tên tệp tin hình ảnh.
        } else {
            return redirect()->back()->withInput()->withErrors(['img' => 'Vui lòng chọn ảnh sản phẩm']);
        }

        $product = Product::create($validatedData); // tạo một bản ghi mới trong bảng products.

        return redirect()->route('admin.products.productList')->with('success', 'Thêm sản phẩm thành công'); //Chuyển hướng người dùng đến route productList và kèm theo thông báo thành công.
    }
    //hien thi formUpdate
    public function productUpdateForm($id)
    {
        $categories = Category::orderBy('name', 'ASC')->get();
        $products = Product::orderBy('id', 'DESC')->paginate(10);
        $product = Product::find($id); //tim id
        return view('admin.products.productUpdateForm', compact('categories', 'products', 'product'));
    }
    //update data
    public function productUpdate(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'img' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'decription' => 'nullable|string',
            'content' => 'nullable|string',
            'price' => 'required|numeric',
            'quantity' => 'nullable|numeric',
            'discount' => 'required|numeric',
            'category_id' => 'required|integer|exists:categories,id',
        ]);

        $id = $request->id;
        $product = Product::findOrFail($id);

        if ($request->hasFile('img')) {
            $imageName = time() . '.' . $request->img->extension();
            $request->img->move(public_path('upload'), $imageName);
            $validatedData['img'] = $imageName;
            // kiểm tra hình củ và xóa
            $oldImagePath = public_path('upload/' . $product->img);
            if (file_exists($oldImagePath)) {
                unlink($oldImagePath);
            }
        }

        $product->update($validatedData);

        return redirect()->route('admin.products.productList')->with('success', 'Cập nhật sản phẩm thành công.');
    }
    // Phương thức để xóa sản phẩm
    public function productDestroy($id)
    {
        $product = Product::findOrFail($id); //// Tìm sản phẩm với ID được cung cấp. Nếu không tìm thấy, sẽ ném ra một ngoại lệ ModelNotFoundException.
        $imgpath = "upload/" . $product->img; //duong dan
        if (file_exists($imgpath)) {
            unlink($imgpath); //xoa
        }
        $product->delete();
        return redirect()->route('admin.products.productList')->with('success', 'Sản phẩm đã được xóa thành công.');
    }
}
