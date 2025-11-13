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
        // Create pivot table for schools and educational stages
        Schema::create('school_educational_stage', function (Blueprint $table) {
            $table->id();
            $table->foreignId('school_id')->constrained()->onDelete('cascade');
            $table->foreignId('educational_stage_id')->constrained()->onDelete('cascade');
            $table->timestamps();
            
            $table->unique(['school_id', 'educational_stage_id']);
        });

        // Create pivot table for schools and student types
        Schema::create('school_student_type', function (Blueprint $table) {
            $table->id();
            $table->foreignId('school_id')->constrained()->onDelete('cascade');
            $table->foreignId('student_type_id')->constrained()->onDelete('cascade');
            $table->timestamps();
            
            $table->unique(['school_id', 'student_type_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('school_student_type');
        Schema::dropIfExists('school_educational_stage');
    }
};
