<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory; //sử dụng trait HasFactory cung cấp các phương thức liên quan đến việc tạo dữ liệu mẫu cho các bản ghi trong cơ sở dữ liệu.

    protected $table = 'products';
    protected $fillable = [
        'name',
        'img',
        'description',
        'price',
        'discount',
        'content',
        'quantity',
        'category_id',
        'is_type',
        'is_new',
        'is_hot',
        'is_hot_deal',
        'is_show_home',
    ]; //Thuộc tính fillable khai báo các cột trong bảng mà có thể được gán giá trị một cách hàng loạt

    protected $cast = [
        'is_type' => 'boolean',
        'is_new' => 'boolean',
        'is_hot' => 'boolean',
        'is_hot_deal' => 'boolean',
        'is_show_home' => 'boolean',
    ];
    public function category()
    {
        return $this->belongsTo(Category::class); //$this đại diện cho thể hiện hiện tại của lớp Product
        //Phương thức belongsTo của Eloquent ORM được sử dụng để xác định mối quan hệ "belongs to" (thuộc về) giữa mô hình Product và mô hình Category.
    }
    public function imageProduct()
    {
        return $this->hasMany(ImageProduct::class);
    }
    public function order_detail()
    {
        return $this->hasMany(order_detail::class);
    }
    public function productVariants()
    {
        return $this->hasMany(ProductVariant::class);
    }
    public function scopeNewProducts($query, $limit) //định nghĩa một query scope có tên là newProducts.
    //Query scope là một cách để thêm điều kiện truy vấn vào Eloquent query một cách dễ dàng.
    //khi định nghĩa một query scope trong model, tham số đầu tiên của phương thức scope luôn là một đối tượng query.
    //$query trong scope là một đối tượng truy vấn Eloquen
    {
        // return $query->orderBy('id', 'desc')->limit($limit)->with(['category']);
        return $query->where('is_type', 1)
            ->where('is_show_home', 1)
            ->orderBy('id', 'desc')
            ->limit($limit)
            ->with(['category']);
    }

    public function scopeBestsellerProducts($query, $limit)
    {
        return $query->where('sold', '>', 0)->orderBy('sold', 'desc')->limit($limit)->with(['category']);
    }

    public function scopeInStockProducts($query, $limit)
    {
        return $query->where('quantity', '>', 0)->orderBy('id', 'desc')->limit($limit)->with(['category']);
    }


    public static function createProduct($data)
    {
        return self::create($data); // Gọi phương thức tĩnh create của lớp hiện tại (self đại diện cho lớp hiện tại).
        //Phương thức create của Eloquent được sử dụng để tạo một bản ghi mới trong csdl dựa trên dữ liệu truyền vào.
    }

    public static function getProductById($id)
    {
        return self::find($id);
    }

    public static function updateProduct($id, $data)
    {
        $product = self::find($id);
        if ($product) {
            $product->update($data);
            return $product;
        }
        return null;
    }

    public static function deleteProduct($id)
    {
        $product = self::find($id);
        if ($product) {
            $product->delete();
            return true;
        }
        return false;
    }

    public static function getProductsByCategory($category_id)
    {
        return self::where('category_id', $category_id)->get();
    }

    public static function searchProductByName($keyword)
    {
        return self::where('name', 'like', '%' . $keyword . '%')->get();
    }

    public static function searchProductByPriceRange($minPrice, $maxPrice)
    {
        return self::whereBetween('price', [$minPrice, $maxPrice])->get();
    }
}
