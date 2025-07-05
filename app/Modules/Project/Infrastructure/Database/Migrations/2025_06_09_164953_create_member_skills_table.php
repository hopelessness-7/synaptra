<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('member_skills', function (Blueprint $table) {
            $table->id();
            $table->foreignId('member_id')->constrained('project_members')->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('skill');
            $table->tinyInteger('level')->unsigned()->default(5); // от 1 до 10
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('member_skills');
    }
};
