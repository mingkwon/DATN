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
}
