<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'daily_id',
        'like',
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
