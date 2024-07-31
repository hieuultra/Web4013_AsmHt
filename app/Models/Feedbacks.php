<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedbacks extends Model
{
    use HasFactory;
    protected $table = 'feedbacks';
    protected $fillable = ['nameUser', 'emailUser', 'phoneUser', 'content', 'status_feedbacks_id'];
    public function statusFeedback()
    {
        return $this->belongsTo(StatusFeedbacks::class); //$this đại diện cho thể hiện hiện tại của lớp Product
        //Phương thức belongsTo của Eloquent ORM được sử dụng để xác định mối quan hệ "belongs to" (thuộc về) giữa mô hình Product và mô hình Category.
    }
}
