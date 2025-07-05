<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('project_members', function (Blueprint $table) {
            $table->id();

            $table->foreignId('project_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('user_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('role_id')->constrained('project_roles')->cascadeOnUpdate()->cascadeOnDelete();

            $table->enum('grade', ['intern', 'junior', 'middle', 'senior', 'lead']);
            $table->enum('specialization', ['frontend', 'backend', 'fullstack', 'qa', 'devops', 'pm']);

            $table->float('load')->default(1.0); // 1.0 = 100%
            $table->boolean('is_available')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('project_members');
    }
};
