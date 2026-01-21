<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PostInteractionNotification extends Notification
{
    use Queueable;

    protected $actor;
    protected $post;
    protected $type;

    /**
     * $type = like | comment
     */
    public function __construct($actor, $post, string $type)
    {
        $this->actor = $actor;
        $this->post = $post;
        $this->type  = $type;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'type' => $this->type,
            'actor' => [
                'id' => $this->actor->id,
                'name' => $this->actor->name,
                'avatar_image' => $this->actor->avatar_image,
            ],
            'post' => [
                'id' => $this->post->id,
                'content' => str($this->post->content)->limit(80),
            ],
            'message' => $this->type === 'like'
                ? "{$this->actor->name} liked your post"
                : "{$this->actor->name} commented on your post",
        ];
    }

    
}
