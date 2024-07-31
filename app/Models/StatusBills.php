<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusBills extends Model
{
    use HasFactory;
    protected $table = 'status_bills';
    protected $fillable = ['nameStatusBill'];

    public function bills()
    {
        return $this->hasMany(Bills::class); // thiết lập mối quan hệ một-nhiều (one-to-many) giữa bảng categories và bảng products.
    }
}
