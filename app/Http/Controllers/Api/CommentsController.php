<?php

namespace App\Http\Controllers\Api;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CommentRequest;
use App\Http\Resources\CommentResource;
use App\Notifications\PostInteractionNotification;

class CommentsController extends Controller
{
    //

    public function index(Post $post)
    {
        return CommentResource::collection($post->comments()->with('user')->get());
    }
    public function store(CommentRequest $request, Post $post)
    {
        $authUserId = $request->user('sanctum')?->id;
        // สร้างคอมเมนต์ใหม่ให้กับโพสต์นี้
        $comment = $post->comments()->create([
            // ผู้ที่คอมเมนต์ (มาจาก token)
            'user_id' => $authUserId,

            // เนื้อหาคอมเมนต์
            'content' => $request->input('content'),
        ]);

        // 2️⃣ ส่ง notification (ห้ามแจ้งเตือนตัวเอง)
        if ($post->user_id !== $authUserId) {
            $post->user->notify(
                new PostInteractionNotification(
                    $request->user('sanctum'),     // คนที่ comment
                    $post,
                    'comment',
                )
            );
        }

        // ส่งข้อมูลกลับพร้อม user
        return new CommentResource(
            $comment->load('user')
        );
    }
}
