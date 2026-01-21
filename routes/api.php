<?php

/**
 * =========================================================
 * Imports: Controllers
 * =========================================================
 */

use App\Http\Controllers\Api\AuthUserController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\LikeController;
use App\Http\Controllers\Api\CommentsController;
use App\Http\Controllers\Api\NotificationController;
use App\Http\Controllers\Admin\FollowController;
use App\Http\Controllers\Admin\AuthController;

/**
 * =========================================================
 * Public Routes (ไม่ต้อง Login)
 * =========================================================
 */

/**
 * -------------------------
 * Authentication (Public)
 * -------------------------
 */
// สมัครสมาชิก
Route::post('user/register', [UserController::class, 'store']);

// Login
Route::post('user/login', [UserController::class, 'auth']);

// Forgot / Reset Password
Route::post('/forgot-password', [AuthUserController::class, 'forgotPassword']);
Route::post('/reset-password', [AuthUserController::class, 'resetPassword']);


/**
 * -------------------------
 * Posts (Public)
 * -------------------------
 */
// ดึง post ทั้งหมด (feed)
Route::get('posts', [PostController::class, 'index']);


/**
 * -------------------------
 * Users (Public)
 * -------------------------
 */
// ค้นหา user
Route::get('/users/search', [UserController::class, 'search']);


/**
 * -------------------------
 * Comments (Public)
 * -------------------------
 */
// ดึง comment ของ post
Route::get('/posts/{post}/comments', [CommentsController::class, 'index']);

// เพิ่ม comment ให้ post
Route::post('/posts/{post}/add-comment', [CommentsController::class, 'store']);


/**
 * =========================================================
 * Protected Routes (ต้อง Login ด้วย Sanctum)
 * =========================================================
 */
Route::middleware('auth:sanctum')->group(function () {

    /**
     * -------------------------
     * Authentication (Protected)
     * -------------------------
     */
    // Logout
    Route::post('user/logout', [UserController::class, 'logout']);


    /**
     * -------------------------
     * User Profile
     * -------------------------
     */
    // ดู profile user ตาม username
    Route::get('/users/{name}', [UserController::class, 'show']);

    // update avatar
    Route::post('/user/update-image', [UserController::class, 'updateProfile']);

    // update cover photo
    Route::post('/user/update-cover-image', [UserController::class, 'updateProfile']);

    // update bio / profile info
    Route::put('/user/update-profile', [UserController::class, 'updateProfile']);

    // ดึง post ของ user
    Route::get('/users/{id}/posts', [PostController::class, 'getPostsByUser']);

    // ดึง user ทั้งหมด (เช่น admin / list)
    Route::get('/users/', [UserController::class, 'index']);


    /**
     * -------------------------
     * Posts (Protected)
     * -------------------------
     */
    // ดู post เดี่ยว
    Route::get('/posts/{id}', [PostController::class, 'show']);

    // สร้าง post (ของ user ที่ login)
    Route::post('/post/postByuser', [PostController::class, 'store']);

    // (ซ้ำ route เดิม แต่คงไว้ตามของเดิม)
    Route::post('create/user', [PostController::class, 'store']);


    /**
     * -------------------------
     * Likes
     * -------------------------
     */
    // like / unlike post
    Route::post('/posts/{post}/like', [LikeController::class, 'toggle']);


    /**
     * -------------------------
     * Follow System
     * -------------------------
     */
    // follow user
    Route::post('/users/{user}/follow', [FollowController::class, 'follow']);

    // unfollow user
    Route::delete('/users/{user}/delete', [FollowController::class, 'unfollow']);

    // user ที่เรากำลัง follow
    Route::get('/me/followings', [FollowController::class, 'myFollowings']);

    // user ที่ follow เรา
    Route::get('/me/followers', [FollowController::class, 'myFollowers']);


    /**
     * -------------------------
     * Notifications
     * -------------------------
     */
    // notification ทั้งหมด
    Route::get('/notifications', [NotificationController::class, 'index']);

    // notification ที่ยังไม่ได้อ่าน
    Route::get('/notifications/unread', [NotificationController::class, 'unread']);

    // mark notification เป็นอ่านแล้ว
    Route::post('/notifications/read/{id}', [NotificationController::class, 'markAsRead']);

    // mark notification ทั้งหมดเป็นอ่านแล้ว
    Route::post('/notifications/read-all', [NotificationController::class, 'markAllAsRead']);


    // post
    Route::delete('/user/post/{post}', [PostController::class, 'destroy']);
    Route::put('/user/post/{post}/update', [PostController::class, 'update']);
});
