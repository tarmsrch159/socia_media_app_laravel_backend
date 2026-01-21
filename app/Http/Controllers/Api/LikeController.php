<?php

namespace App\Http\Controllers\Api;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Notifications\PostInteractionNotification;

/**
 * LikeController
 * ใช้สำหรับจัดการการกดไลก์ / ยกเลิกไลก์ ของโพสต์
 */
class LikeController extends Controller
{
    /**
     * toggle
     * - ถ้า user เคยไลก์โพสต์นี้ → ลบไลก์ (unlike)
     * - ถ้า user ยังไม่เคยไลก์ → เพิ่มไลก์ (like)
     *
     * @param Post    $post     โพสต์ที่ถูกกดไลก์
     * @param Request $request  request ที่มีข้อมูล user (จาก auth:sanctum)
     */
    public function toggle(Post $post, Request $request)
    {
        // ดึง user ที่ login อยู่ (จาก token / sanctum)
        $user = $request->user();

        // ตรวจสอบว่า user คนนี้เคยไลก์โพสต์นี้หรือยัง
        $like = $post->likes()
            ->where('user_id', $user->id)
            ->first();

        // 👉 กรณีเคยไลก์แล้ว → ยกเลิกไลก์
        if ($like) {
            $like->delete();

            return response()->json([
                'liked' => false,                     // สถานะล่าสุด (unliked)
                'likes_count' => $post->likes()->count() // จำนวนไลก์ทั้งหมด
            ]);
        }

        // 👉 กรณียังไม่เคยไลก์ → เพิ่มไลก์
        $post->likes()->create([
            'user_id' => $user->id
        ]);

        // 🔔 ส่ง notification (ห้ามแจ้งเตือนตัวเอง)
        if ($post->user_id !== $user->id) {
            $post->user->notify(
                new PostInteractionNotification($user, $post, 'like')
            );
        }

        return response()->json([
            'liked' => true,                          // สถานะล่าสุด (liked)
            'likes_count' => $post->likes()->count()  // จำนวนไลก์ทั้งหมด
        ]);
    }
}
