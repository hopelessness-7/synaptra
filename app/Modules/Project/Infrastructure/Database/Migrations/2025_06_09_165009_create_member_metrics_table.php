<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('member_metrics', function (Blueprint $table) {
            $table->id();
            $table->foreignId('member_id')->constrained('project_members')->cascadeOnUpdate()->cascadeOnDelete();
            $table->integer('tasks_completed')->default(0);
            $table->float('avg_task_time')->nullable();
            $table->float('total_work_time')->default(0);
            $table->float('quality_score')->nullable();
            $table->float('activity_score')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('member_metrics');
    }
};
