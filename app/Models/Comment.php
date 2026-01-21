<?php

namespace App\Models;


use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //
    use HasFactory;

    protected $fillable = [
        'user_id',
        'post_id',
        'content',
    ];

    /**
     * คนที่คอมเมนต์
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * โพสต์ที่คอมเมนต์อยู่
     */
    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    /**
     * วันที่คอมเมนต์
     */
    public function getCreatedTimeAttribute()
    {
        if (!$this->created_at)
            return null;

        $date = $this->created_at->timezone('Asia/Bangkok');
        $now = Carbon::now('Asia/Bangkok');

        // ภายใน 24 ชม.
        if ($date->diffInHours($now) < 24) {
            return $date->diffForHumans();
        }

        // เมื่อวาน
        if ($date->isYesterday()) {
            return 'เมื่อวาน เวลา ' . $date->format('H:i');
        }

        // ปีเดียวกัน
        if ($date->isSameYear($now)) {
            return $date->translatedFormat('j M') . ' เวลา ' . $date->format('H:i');
        }

        // คนละปี
        return $date->translatedFormat('j M Y') . ' เวลา ' . $date->format('H:i');
    }
}

