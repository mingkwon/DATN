<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'phone',
        'time',
        'date',
        'guest',
        'table',
        'note',
        'status',
        'table_id'
    ];

    protected $appends = ['display_status'];

    public function getDisplayStatusAttribute()
    {
        $now = Carbon::now();
        $bookingTime = Carbon::parse($this->date . ' ' . $this->time);
        $expireTime = $bookingTime->copy()->addMinutes(15);

        // Debug
        \Log::info("Booking ID {$this->id}: now={$now}, bookingTime={$bookingTime}, expire={$expireTime}");

        // ĐÃ XÁC NHẬN
        if ($this->status === 'Đã xác nhận') {

            // Chờ khách: từ giờ đặt → +15 phút
            if ($now->between($bookingTime, $expireTime)) {
                return 'Chờ khách';
            }

            // Quá 15 phút
            if ($now->greaterThan($expireTime)) {
                return 'Đã quá hạn';
            }
        }

        // CHỜ XÁC NHẬN mà quá giờ đặt
        if ($this->status === 'Chờ xác nhận' && $now->greaterThan($bookingTime)) {
            return 'Đã quá hạn';
        }

        return $this->status;
    }

}
