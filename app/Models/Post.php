<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    //

    /** @use HasFactory<\Database\Factories\PostFactory> */
    use HasFactory;

    protected $fillable = [
        'user_id',
        'content',
        'image_url',
    ];

    protected $appends = [
        'full_image_path',
        'created_time'
    ];

    public function getCreatedTimeAttribute()
    {
        if (!$this->created_at) return null;

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

    /**
     * Accessor: สร้าง Full URL สำหรับรูปภาพให้อัตโนมัติ
     * เวลาเรียกใช้ $post->full_image_path
     */
    public function getFullImagePathAttribute()
    {
        return $this->image_url ? asset($this->image_url) : null;
    }

    /**
     * Relationship: โพสต์นี้เป็นของใคร (Many-to-One)
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relationship: โพสต์นี้มีคอมเมนต์อะไรบ้าง (One-to-Many)
     */
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class)->latest();
    }

    /**
     * Relationship: โพสต์นี้มีใคร Like บ้าง (Polymorphic One-to-Many)
     */
    public function likes(): MorphMany
    {
        return $this->morphMany(Like::class, 'likeable');
    }

    /**
     * Helper: เช็คว่า User คนนี้ Like โพสต์นี้ไปหรือยัง
     */
    public function isLikedBy(User $user): bool
    {
        return $this->likes()->where('user_id', $user->id)->exists();
    }
}
