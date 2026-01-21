<?php

namespace App\Http\Controllers\Admin;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{

    public function index()
    {

        return view('admin.posts.index')->with([
            'posts' => Post::all()
        ]);
    }

    public function create()
    {

        return view('admin.posts.create')->with([
            "users" => User::all()
        ]);
    }

    //
    public function store(Request $request)
    {
        // 1. Validation (ตรวจสอบข้อมูล)
        $request->validate([
            'content' => 'required|string|max:1000',
            'image_url' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // จำกัด 2MB
        ]);

        $data = [
            'user_id' => $request->input('user_id'),
            'content' => $request->input('content'),
        ];
        // 2. จัดการรูปภาพ (ถ้ามี)
        if ($request->hasFile('image_url')) {
            // เก็บไฟล์ใน storage/app/public/posts และคืนค่า path
            $file = $request->file('image_url');
            $image_name = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('posts', $image_name, 'public');
            $path = 'storage/posts/' . $image_name;
            $data['image_url'] = $path;
        }

        // 3. บันทึกลง PostgreSQL
        Post::create($data);

        return redirect()->route('admin.posts.index')->with([
            'success' => 'สร้างโพสเรียบร้อยแล้ว'
        ]);
    }


    public function edit(Request $request)
    {

        return view('admin.posts.edit')->with([
            'post' => Post::findOrFail($request->id)
        ]);
    }

    public function update(Request $request)
    {

        $request->validate([
            'content' => 'required|string|max:1000',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // จำกัด 2MB
        ]);
    }

    // ลบโพสต์
    public function destroy(Post $post)
    {


        // ลบรูปภาพออกจาก Storage ด้วย
        if ($post->image_url) {
            Storage::disk('public')->delete($post->image_url);
        }

        $post->delete();

        return redirect()->route('admin.posts.index')->with([
            'success' => 'ลบโพสเรียบร้อยแล้ว'
        ]);
    }
}
