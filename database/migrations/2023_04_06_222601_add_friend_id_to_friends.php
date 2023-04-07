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
        Schema::table('friends', function (Blueprint $table) {
            $table->foreignId('friend_id')->nullable()->constrained('users')->after('user_id');
            $table->index('friend_id', 'friend_user_idx');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('friends', function (Blueprint $table) {
            Schema::dropIfExists('friends');
        });
    }
};
