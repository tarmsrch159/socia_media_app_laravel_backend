<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\DatabaseNotification;

class Notification extends DatabaseNotification
{
    //
    protected $appends = ['created_time'];

    public function getCreatedTimeAttribute()
    {
        if (!$this->created_at) return null;

        $date = $this->created_at->timezone('Asia/Bangkok');
        $now  = Carbon::now('Asia/Bangkok');

        if ($date->diffInHours($now) < 24) {
            return $date->diffForHumans();
        }

        if ($date->isYesterday()) {
            return 'เมื่อวาน เวลา ' . $date->format('H:i');
        }

        if ($date->isSameYear($now)) {
            return $date->translatedFormat('j M') . ' เวลา ' . $date->format('H:i');
        }

        return $date->translatedFormat('j M Y') . ' เวลา ' . $date->format('H:i');
    }
}
