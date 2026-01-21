<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Admin>
 */
class AdminFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
     public function definition(): array
    {
        return [
            'name' => "admin",
            'email' => "admin@email.com",
            'password' => Hash::make('123456'), // รหัสผ่านเริ่มต้นคือ 123456
            'role' => fake()->randomElement(['super_admin', 'moderator', 'editor']),
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * สำหรับสร้าง Super Admin โดยเฉพาะ
     */
    public function superAdmin(): static
    {
        return $this->state(fn (array $attributes) => [
            'role' => 'super_admin',
        ]);
    }
}
