<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $fillable = [
        'table_id',
        'customer_name',
        'phone',
        'guests',
        'booking_time',
        'note',
        'status',
    ];

    // Quan hệ với bảng tables
    public function table()
    {
        // return $this->belongsTo(Table::class);
        return $this->belongsTo(Table::class, 'table_id');
    }
}