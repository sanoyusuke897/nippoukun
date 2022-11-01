<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $casts = [
        'user_id',
        'daily_id',
        'report'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function daily()
    {
        return $this->belongsTo(Daily::class);
    }
}
