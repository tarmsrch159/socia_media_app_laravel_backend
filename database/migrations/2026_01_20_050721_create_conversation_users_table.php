<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('conversation_users', function (Blueprint $table) {
             $table->id(); // BIGINT auto increment

            // FK → conversations.id (BIGINT)
            $table->foreignId('conversation_id')
                ->constrained()
                ->cascadeOnDelete();

            // FK → users.id (BIGINT)
            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->string('role', 20)->default('member'); // admin | member
            $table->boolean('is_muted')->default(false);
            $table->boolean('is_blocked')->default(false);

            $table->timestamp('joined_at')->useCurrent();
            $table->timestamp('last_read_at')->nullable();

            $table->unique(['conversation_id', 'user_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('conversation_users');
    }
};
