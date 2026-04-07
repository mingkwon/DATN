<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Table extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'ten_ban',
        'loai_ban',
        'vi_tri',
        'trang_thai'
    ];

    // Relationship: Booking sớm nhất trong tương lai (đã xác nhận)
    public function latestBooking()
    {
        return $this->hasOne(Book::class, 'table_id', 'id')
            ->whereIn('status', ['Đã xác nhận', 'Chờ khách']) // Lấy cả hai trạng thái còn hiệu lực
            ->whereRaw("CONCAT(date, ' ', time) >= ?", [now()->subMinutes(15)->toDateTimeString()]) // Chưa quá hạn 15p
            ->orderBy('date', 'asc')
            ->orderBy('time', 'asc')
            ->latest('id') // Ưu tiên booking mới nhất nếu có trùng thời gian
            ->limit(1);
    }
    public function orders()
    {
        return $this->hasMany(Order::class, 'table_id', 'id');
    }

    public function currentOrder()
    {
        return $this->hasOne(Order::class, 'table_id')
            ->where('trang_thai', 'dang_mo')
            ->latest('id');
    }
}
