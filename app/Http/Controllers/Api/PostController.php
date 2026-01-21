<?php

namespace App\Http\Controllers\Api;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Http\Requests\StoreUserRequest;
use Illuminate\Support\Facades\Storage;
use App\Services\SupabaseStorageService;

class PostController extends Controller
{
    //

    public function index(Request $request)
    {

        $userId = $request->user('sanctum')?->id;

        $posts = Post::with('user')
            ->withCount('likes')
            ->withExists([
                'likes as liked' => function ($q) use ($userId) {
                    if ($userId) {
                        $q->where('user_id', $userId);
                    }
                }
            ])
            ->latest()
            ->get();

        return response()->json([
            'posts' => $posts
        ]);
    }

    public function show($id)
    {
        $post = Post::with([
            'user:id,name,avatar',
            'comments.user'
        ])
            ->withCount('likes')
            ->findOrFail($id);

        $post->liked = false;

        if (Auth::check()) {
            $post->liked = $post->isLikedBy(Auth::user());
        }


        return response()->json([
            'data' => $post
        ]);
    }



    public function store(Request $request, SupabaseStorageService $storage)
    {
        // 1. Validation
        $request->validate([
            'content' => 'required|string|max:1000',
            'imagePost_url' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // 2. ดึง user จาก token (Sanctum)
        $user = $request->user(); // ✅ สำคัญที่สุด

        $data = [
            'user_id' => $user->id,   // ✅ FIX ตรงนี้
            'content' => $request->input('content'),
        ];
        // 2. จัดการรูปภาพ (ถ้ามี)
        if ($request->hasFile('imagePost_url')) {
            // เก็บไฟล์ใน storage/app/public/posts และคืนค่า path
            $path = $storage->upload(
                $request->file('imagePost_url'),
                'posts',
                'postImage'
            );

            $data['image_url'] = $path;
        }

        // 3. บันทึกลง PostgreSQL
        Post::create($data);

        return response()->json([
            'success' => 'สร้างโพสเรียบร้อยแล้ว'
        ]);
    }

    public function getPostsByUser(Request $request, $id)
    {
        $authUserId = $request->user('sanctum')?->id;

        $posts = Post::with([
            'user',
            'comments.user',
        ])
            ->withCount('likes')
            ->withExists([
                'likes as liked' => function ($q) use ($authUserId) {
                    $q->where('user_id', $authUserId);
                }
            ])
            ->where('user_id', $id)
            ->latest()
            ->get();

        return PostResource::collection($posts);
    }

    public function update(Request $request, Post $post, SupabaseStorageService $storage)
    {

        $request->validate([
            'content' => 'required|string|max:1000',
            'imagePost_url' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $post->content = $request->input('content');

        if ($request->hasFile('imagePost_url')) {

            if ($post->image_url) {
                $storage->delete($request->imagePost_url);
            }

             // upload รูปใหม่ไป Supabase
            $postImageUrl = $storage->upload(
                $request->file('imagePost_url'),
                'posts',
                'postImage'
            );

            $post->image_url = $postImageUrl;
        } else {
            $post->image_url = null;
        }

        $post->save();

        return response()->json([
            'success' => 'แก้ไขโพสเรียบร้อยแล้ว'
        ]);
    }

    // ลบโพสต์
    public function destroy(Post $post)
    {
        $authUser = Auth::user();

        if ($post->user_id !== $authUser->id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        // ลบรูปภาพออกจาก Storage ด้วย
        if ($post->image_url) {
            Storage::disk('public')->delete($post->image_url);
        }

        $post->delete();

        return response()->json([
            'success' => 'ลบโพสเรียบร้อยแล้ว'
        ]);
    }

    /**
     * Remove old images from storage
     */
    public function removeProductImageFromStorage($file)
    {
        $path = storage_path('app/public/' . $file);
        if (File::exists($path)) {
            File::delete($path);
        }
    }

    /**
     * Upload and save product images
     */
    public function saveImage($file)
    {
        $image_name = time() . '_' . $file->getClientOriginalName();
        $file->storeAs('posts', $image_name, 'public');
        return 'storage/posts/' . $image_name;
    }
}
