<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\Size;
use App\Models\Color;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }
    public function productList()
    {
        $categories = Category::orderBy('name', 'ASC')->get();
        // $products = Product::orderBy('id', 'desc')->paginate(10);
        $products = Product::with('productVariants')->orderBy('id', 'desc')->paginate(10);
        return view('admin.products.productList', compact('categories', 'products'));
    }

    public function viewProAdd()
    {
        $categories = Category::orderBy('name', 'asc')->get();
        $sizes = Size::all();
        $colors = Color::all();
        return view('admin.products.viewProAdd', compact('categories', 'sizes', 'colors'));
    }
    public function productAdd(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'img' => 'required|file|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description' => 'nullable|string',
            'content' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|numeric',
            'discount' => 'required|numeric',
            'category_id' => 'required|integer|exists:categories,id',
            'is_type' => 'required|boolean',
            'sizes' => 'nullable|array',
            'colors' => 'nullable|array',
            'quantities' => 'nullable|array',
            'variant_images.*' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        //chuyen doi gia tri checkbox thanh boolean
        $validatedData['is_new'] = $request->has('is_new') ? 1 : 0;
        $validatedData['is_hot'] = $request->has('is_hot') ? 1 : 0;
        $validatedData['is_hot_deal'] = $request->has('is_hot_deal') ? 1 : 0;
        $validatedData['is_show_home'] = $request->has('is_show_home') ? 1 : 0;

        // Xử lý ảnh chính của sản phẩm
        if ($request->hasFile('img')) {
            $imageName = time() . '.' . $request->img->extension(); //Tạo tên tệp tin duy nhất dựa trên thời gian hiện tại.
            //$request->img->extension() sẽ trả về jpg,..., là phần mở rộng của tệp tin.
            $request->img->move(public_path('upload'), $imageName); //Di chuyển tệp tin đến thư mục public/upload.
            $validatedData['img'] = $imageName; //Cập nhật dữ liệu đã xác thực với tên tệp tin hình ảnh.
        } else {
            return redirect()->back()->withInput()->withErrors(['img' => 'Vui lòng chọn ảnh sản phẩm']);
        }

        $product = Product::create($validatedData); // tạo một bản ghi mới trong bảng products.

        // Xử lý biến thể
        $sizes = $request->input('sizes', []);
        $colors = $request->input('colors', []);
        $quantities = $request->input('quantities', []);
        $variantImages = $request->file('variant_images', []);

        $variants = [];

        if (count($sizes) == count($colors) && count($sizes) == count($quantities)) {
            foreach ($sizes as $index => $sizeId) {
                $colorId = $colors[$index];
                $quantity = $quantities[$index];
                $imagePath = isset($variantImages[$index]) ? $this->storeImage($variantImages[$index], $product->id) : null;

                $variants[] = [
                    'size_id' => $sizeId,
                    'color_id' => $colorId,
                    'price' => $request->input('price'),
                    'quantity' => $quantity,
                    'image' => $imagePath,
                ];
            }

            // Lưu tất cả biến thể vào cơ sở dữ liệu
            foreach ($variants as $variant) {
                $product->productVariants()->updateOrCreate(
                    [
                        'size_id' => $variant['size_id'],
                        'color_id' => $variant['color_id'],
                    ],
                    $variant
                );
            }
        } else {
            return redirect()->back()->withInput()->withErrors(['sizes' => 'Dữ liệu biến thể không hợp lệ']);
        }

        //lay id pro vua add de them dc album
        $productId = $product->id;

        //xu ly them album
        if ($request->hasFile('list_img')) {
            $list_img = $request->file('list_img');
            foreach ($list_img as $img) {
                if ($img) {
                    $path = $img->store('upload/imageProduct/id_' . $productId, 'public');
                    $product->imageProduct()->create([
                        'product_id' => $productId,
                        'image' => $path,
                    ]);
                }
            }
        }
        return redirect()->route('admin.products.productList')->with('success', 'Thêm sản phẩm thành công'); //Chuyển hướng người dùng đến route productList và kèm theo thông báo thành công.
    }
    private function storeImage($image, $productId)
    {
        // Tạo tên tệp tin duy nhất dựa trên thời gian hiện tại và một chuỗi ngẫu nhiên
        $imageName = time() . '_' . uniqid() . '.' . $image->extension();
        $destinationPath = public_path('uploads/variants/id_' . $productId);

        // Tạo thư mục nếu chưa tồn tại
        if (!file_exists($destinationPath)) {
            mkdir($destinationPath, 0755, true);
        }

        // Di chuyển ảnh vào thư mục
        $image->move($destinationPath, $imageName);

        // Trả về đường dẫn ảnh
        return 'uploads/variants/id_' . $productId . '/' . $imageName;
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
            'description' => 'nullable|string',
            'content' => 'nullable|string',
            'price' => 'required|numeric',
            'quantity' => 'nullable|numeric',
            'discount' => 'required|numeric',
            'category_id' => 'required|integer|exists:categories,id',
            'is_type' => 'required|boolean',
        ]);

        //chuyen doi gia tri checkbox thanh boolean
        $validatedData['is_new'] = $request->has('is_new') ? 1 : 0;
        $validatedData['is_hot'] = $request->has('is_hot') ? 1 : 0;
        $validatedData['is_hot_deal'] = $request->has('is_hot_deal') ? 1 : 0;
        $validatedData['is_show_home'] = $request->has('is_show_home') ? 1 : 0;

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
        //xoa album
        $product->imageProduct()->delete();

        //xoa toan bo image trong folder
        $path = 'upload/imageProduct/id_' . $id;
        if (Storage::disk('public')->exists($path)) {
            Storage::disk('public')->deleteDirectory($path); //xoa thu muc
        }
        //xoa product
        $product->delete();
        return redirect()->route('admin.products.productList')->with('success', 'Sản phẩm đã được xóa thành công.');
    }
}
