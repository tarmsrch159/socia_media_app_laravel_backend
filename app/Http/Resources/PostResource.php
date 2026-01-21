<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $user = $request->user();
        return [
            'id' => $this->id,
            'content' => $this->content,
            'image' => $this->full_image_path,

            // เวลาแบบ Facebook
            'created_time' => $this->created_time,

            // Like system
            'likes_count' => $this->likes()->count(),
            'liked' => $user
                ? $this->isLikedBy($user)
                : false,

            // User (ส่งเท่าที่จำเป็น)
            'user' => [
                'id' => $this->user->id,
                'name' => $this->user->name,
                'username' => $this->user->username,
                'avatar' => $this->user->avatar_image,
            ],
            'comments_count' => $this->comments()->count(),
        ];
    }
}
