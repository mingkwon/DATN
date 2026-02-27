<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'ten_khach',
        'phone',
        'table_id',
        'book_id',
        'order_type',         // 'booked' hoặc 'walk_in'
        'trang_thai',               // 'open', 'prepare', 'done', 'cancel'
        'tong_tien_truoc_giam',     // subtotal
        'giam_gia',
        'thue',
        'tong_thanh_toan',
        'ghi_chu_don',
    ];

    public function orderItems()
    {
        return $this->hasMany(OrderItems::class, 'order_id');
    }

    public function ban_an()
    {
        return $this->belongsTo(Table::class, 'table_id', 'id');
    }

    public function booking()
{
    return $this->belongsTo(Book::class, 'book_id');
}
}
