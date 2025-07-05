<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('login_block_logs', function (Blueprint $table) {
            $table->id();
            $table->string('email')->index();
            $table->string('reason');
            $table->unsignedInteger('attempts');
            $table->string('ip_address', 45)->nullable();
            $table->boolean('blocked')->default(false);
            $table->text('user_agent')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('login_block_logs');
    }
};
