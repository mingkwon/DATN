<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'phone',
        'table_id',
        'book_id',
        'order_type',
        'tong_tien_truoc_giam',
        'giam_gia',
        'thue',
        'tong_thanh_toan'
    ];
}
