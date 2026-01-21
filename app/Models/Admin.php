<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use HasFactory, Notifiable;
    //
    protected $fillable = [
        'name',
        'email',
        'password',
        'role'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * การทำ Type Casting สำหรับข้อมูลบางประเภท
     */
    protected function casts(): array
    {
        return [
            'password' => 'hashed', // ให้ Laravel ช่วย Hash รหัสผ่านอัตโนมัติ
        ];
    }

    /**
     * Helper Method: ตรวจสอบว่าเป็น Super Admin หรือไม่
     */
    public function isSuperAdmin(): bool
    {
        return $this->role === 'super_admin';
    }
}
