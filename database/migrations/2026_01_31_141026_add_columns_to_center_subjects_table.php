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
        Schema::table('center_subjects', function (Blueprint $table) {
            if (!Schema::hasColumn('center_subjects', 'educational_center_id')) {
                $table->foreignId('educational_center_id')->constrained()->onDelete('cascade');
            }
            if (!Schema::hasColumn('center_subjects', 'subject_id')) {
                $table->foreignId('subject_id')->constrained()->onDelete('cascade');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('center_subjects', function (Blueprint $table) {
            //
        });
    }
};
