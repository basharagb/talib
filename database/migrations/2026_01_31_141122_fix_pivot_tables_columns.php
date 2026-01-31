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
        // Fix school_grades pivot table
        Schema::table('school_grades', function (Blueprint $table) {
            if (!Schema::hasColumn('school_grades', 'school_id')) {
                $table->foreignId('school_id')->constrained()->onDelete('cascade');
            }
            if (!Schema::hasColumn('school_grades', 'grade_id')) {
                $table->foreignId('grade_id')->constrained()->onDelete('cascade');
            }
        });

        // Fix kindergarten_grades pivot table
        if (Schema::hasTable('kindergarten_grades')) {
            Schema::table('kindergarten_grades', function (Blueprint $table) {
                if (!Schema::hasColumn('kindergarten_grades', 'kindergarten_id')) {
                    $table->foreignId('kindergarten_id')->constrained()->onDelete('cascade');
                }
                if (!Schema::hasColumn('kindergarten_grades', 'grade_id')) {
                    $table->foreignId('grade_id')->constrained()->onDelete('cascade');
                }
            });
        }

        // Fix school_educational_stage pivot table
        if (Schema::hasTable('school_educational_stage')) {
            Schema::table('school_educational_stage', function (Blueprint $table) {
                if (!Schema::hasColumn('school_educational_stage', 'school_id')) {
                    $table->foreignId('school_id')->constrained()->onDelete('cascade');
                }
                if (!Schema::hasColumn('school_educational_stage', 'educational_stage_id')) {
                    $table->foreignId('educational_stage_id')->constrained()->onDelete('cascade');
                }
            });
        }

        // Fix school_student_type pivot table
        if (Schema::hasTable('school_student_type')) {
            Schema::table('school_student_type', function (Blueprint $table) {
                if (!Schema::hasColumn('school_student_type', 'school_id')) {
                    $table->foreignId('school_id')->constrained()->onDelete('cascade');
                }
                if (!Schema::hasColumn('school_student_type', 'student_type_id')) {
                    $table->foreignId('student_type_id')->constrained()->onDelete('cascade');
                }
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
