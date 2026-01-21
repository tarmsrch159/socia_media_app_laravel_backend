<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\AuthUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Services\SupabaseStorageService;

class UserController extends Controller
{
    //
    public function index()
    {
        $userId = Auth::id();

        if (!$userId) {
            return response()->json(['message' => 'Unauthenticated'], 401);
        }

        return response()->json([
            'data' => User::where('id', '!=', $userId)
                ->select('id', 'name', 'username', 'avatar')
                ->get()
        ]);
    }

    public function store(StoreUserRequest $request)
    {
        if ($request->validated()) {
            User::create($request->validated());
            return response()->json([
                "msg" => "success"
            ]);
        }
        return response()->json([
            "msg" => "error"
        ]);
    }

    public function auth(AuthUserRequest $request)
    {

        if ($request->validated()) {
            $user = User::where('email', $request->validated('email'))->first();
            if (!$user || !Hash::check($request->password, $user->password)) {
                return response()->json([
                    "error" => "These credentials do not match any of our records."
                ]);
            } else {
                return response()->json([
                    "msg" => "success",
                    "user" => UserResource::make($user),
                    "access_token" => $user->createToken("new_user")->plainTextToken
                ]);
            }
        }
    }


    public function updateProfile(Request $request, SupabaseStorageService $storage)
    {
        $user = $request->user();

        // 1️⃣ Validate
        $data = $request->validate([
            'avatar' => 'nullable|image|max:2048',
            'bio' => 'nullable|string|max:160',
            'cover_photo' => 'nullable|image|max:2048',
        ]);

        // 2️⃣ ถ้ามีอัปโหลด avatar ใหม่
        if ($request->hasFile('avatar')) {
            // ลบรูปเก่า (ถ้ามี)
            if ($request->user()->avatar) {
                $storage->delete($request->user()->avatar);
            }


            // upload รูปใหม่ไป Supabase
            $imageUrl = $storage->upload(
                $request->file('avatar'),
                'users',
                'profileImage'
            );

            // บันทึกรูปใหม่
            $data['avatar'] = $imageUrl;
        }

        // 3 ถ้ามีอัปโหลด cover photo ใหม่
        if ($request->hasFile('cover_photo')) {
            // ลบรูปเก่า (ถ้ามี)
            if ($request->user()->cover_photo) {
                
                $storage->delete($request->user()->cover_photo);
            }


            // upload รูปใหม่ไป Supabase
            $coverImageUrl = $storage->upload(
                $request->file('cover_photo'),
                'users',
                'coverImage'
            );

            // บันทึกรูปใหม่
            $data['cover_photo'] = $coverImageUrl;
        }


        // 3️⃣ Update user
        $user->update($data);

        // 4️⃣ Response
        return response()->json([
            'msg' => 'Updated Profile Successfully',
            'user' => new UserResource($user),
        ]);
    }


    //Logout the user
    public function logout(Request $request)
    {
        //ลบAccessTokenของUser และ Logout
        $request->user()->currentAccessToken()->delete();
        return response()->json([
            "msg" => "Logout Successfully"
        ]);
    }

    /**
     * Upload and save product images
     */
    public function saveImage($file)
    {
        $image_name = time() . '_' . $file->getClientOriginalName();
        $file->storeAs('images/profile', $image_name, 'public');
        return 'images/profile/' . $image_name;
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

    public function search(Request $request)
    {
        $q = strtolower($request->q);

        $users = User::whereRaw('LOWER(name) LIKE ?', ["%{$q}%"])
            ->orWhereRaw('LOWER(username) LIKE ?', ["%{$q}%"])
            ->select('id', 'name', 'username', 'avatar')
            ->limit(10)
            ->get();

        return response()->json([
            'data' => $users
        ]);
    }

    public function show(Request $request, string $name)
    {

        $user = User::where('name', $name)
            ->select('id', 'name', 'username', 'avatar', 'bio', 'cover_photo')
            ->with([
                'posts' => function ($q) {
                    $q->latest()
                        ->withCount(['likes', 'comments'])
                        ->with([
                            'user:id,name,username,avatar',
                            'comments.user:id,name,username,avatar'
                        ]);
                },
                'comments' => function ($q) {
                    $q->latest()
                        ->with('post:id')
                        ->limit(10);
                },
                'followings:id,name,username,avatar',
                'followers:id,name,username,avatar',

            ])
            ->firstOrFail();

        return response()->json([
            'user' => $user,
            // 'user' => new UserResource($user),
            // 'is_owner' => $authUser?->id === $user->id
        ]);
    }
}
