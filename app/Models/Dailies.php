<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Dailies extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'report',
        'clocking',
    ];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d（H:i:s）',
        'updated_at' => 'datetime:Y-m-d（H:i:s）'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comment()
    {
        return $this->hasOne(Comment::class, 'daily_id');
    }

    public function like()
    {
        return $this->hasOne(Like::class, 'daily_id');
    }
}
