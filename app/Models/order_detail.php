<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class order_detail extends Model
{
    use HasFactory;

    protected $fillable = [
        'bills_id',
        'product_id',
        'donGia',
        'quantity',
        'thanhTien'
    ];
    public function bill(){
        return $this->belongsTo(Bills::class);
    }
    public function product(){
        return $this->belongsTo(Product::class);
    }
}

