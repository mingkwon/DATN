<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
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
            ->where('status', 'Đã xác nhận')
            ->whereRaw("CONCAT(date, ' ', time) > ?", [now()->toDateTimeString()])
            ->orderBy('date', 'asc')
            ->orderBy('time', 'asc')
            ->limit(1);
    }

    public function currentOrder()
    {
        return $this->hasOne(Order::class, 'table_id')
            ->where('trang_thai', 'dang_mo')
            ->latest('id');
    }
}
