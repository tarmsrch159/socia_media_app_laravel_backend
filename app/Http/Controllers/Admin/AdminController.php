<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    //

    public function index()
    {
        $todayPosts = Post::whereDay('created_at', Carbon::today())->get();
        $yesterdayPosts = Post::whereDay('created_at', Carbon::yesterday())->get();
        $monthPosts = Post::whereMonth('created_at', Carbon::now()->month)->get();
        $yearPosts = Post::whereYear('created_at', Carbon::now()->year)->get();

        return view('admin.dashboard')->with([
            'todayPosts' => $todayPosts,
            'yesterdayPosts' => $yesterdayPosts,
            'monthPosts' => $monthPosts,
            'yearPosts' => $yearPosts
        ]);
    }
}
