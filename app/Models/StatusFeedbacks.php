<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusFeedbacks extends Model
{
    use HasFactory;
    protected $table = 'status_feedbacks';
    protected $fillable = ['nameStatusFb'];

    public function feedbacks()
    {
        return $this->hasMany(Feedbacks::class); // thiết lập mối quan hệ một-nhiều (one-to-many) giữa bảng categories và bảng products.
    }
}
