<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Payment extends Model
{
    use HasFactory;
    protected $fillable = [
        'order_id',
        'so_tien',
        'phuong_thuc',              // 'tien_mat', 'the', 'chuyen_khoan', 'momo', 'vnpay', 'chia_hoa_don'...
        'trang_thai_thanh_toan',    // 'cho_xu_ly', 'thanh_cong', 'that_bai', 'hoan_tien'
        'ma_giao_dich',
        'thoi_gian_thanh_toan',
        'ghi_chu',
    ];
}
