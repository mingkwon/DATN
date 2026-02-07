<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order_Items extends Model
{
    use HasFactory;
    protected $fillable = [
        'order_id',
        'food_id',                // FK → foods.id
        'so_luong',
        'gia_tai_thoi_diem_dat',    // giá lúc gọi món
        'ghi_chu_mon',              // ít đá, không hành, thêm ớt...
        'trang_thai_mon',           // 'cho_lam', 'dang_lam', 'da_phuc_vu', 'huy'
    ];
}
