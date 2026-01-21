<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    //
    use HasFactory;

    protected $fillable = [
        'user_id',
    ];

    /**
     * คนที่กดไลก์
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * สิ่งที่ถูกไลก์ (Post, Comment ฯลฯ)
     */
    public function likeable()
    {
        return $this->morphTo();
    }
}
