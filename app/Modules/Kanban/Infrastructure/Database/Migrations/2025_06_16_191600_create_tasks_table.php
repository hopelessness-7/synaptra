<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('column_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('assignee_id')->constrained('users')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('creator_id')->constrained('users')->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('title');
            $table->string('description')->nullable();
            $table->integer('position');
            $table->enum('status', ['pending', 'completed', 'cancelled'])->default('pending');
            $table->enum('priority', ['low', 'medium', 'high', 'urgent'])->default('low');
            $table->date('due_date')->nullable();
            $table->datetime('started_at')->nullable();
            $table->datetime('finished_at')->nullable();
            $table->unsignedInteger('estimated_time')->nullable();
            $table->unsignedInteger('spent_time')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
