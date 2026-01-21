<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class FollowController extends Controller
{
    //
    public function follow(User $user)
    {

        $auth = Auth::user();

        if ($auth->id === $user->id) {
            return back()->with('error', 'ไม่สามารถติดตามตัวเองได้');
        }

        $auth->followings()->syncWithoutDetaching([$user->id]);
        return response()->json(['success' => "ติดตามเรียบร้อยแล้ว", "user" => [
            'id' => $user->id,
            'name' => $user->name,
            'username' => $user->username,
            'avatar' => $user->avatar,
        ]]);
    }

    public function unfollow(User $user)
    {
        Auth::user()->followings()->detach($user->id);

        return response()->json(['success' => "เลิกติดตามแล้ว"]);
    }

    public function myFollowings()
    {
        return response()->json([
            'data' => Auth::user()
                ->followings()
                ->select('users.id', 'users.name', 'users.username', 'users.avatar')
                ->get()
        ]);
    }

    public function myFollowers()
    {
        return response()->json([
            'data' => Auth::user()
                ->followers()
                ->select('users.id', 'users.name', 'users.username', 'users.avatar')
                ->get()
        ]);
    }
}
