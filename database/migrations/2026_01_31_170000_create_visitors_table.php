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
        Schema::create('visitors', function (Blueprint $table) {
            $table->id();
            $table->string('ip_address', 45);
            $table->string('user_agent')->nullable();
            $table->string('device_type', 20)->nullable(); // desktop, mobile, tablet
            $table->string('browser', 50)->nullable();
            $table->string('os', 50)->nullable();
            $table->string('country_code', 5)->nullable();
            $table->string('country_name', 100)->nullable();
            $table->string('city', 100)->nullable();
            $table->string('region', 100)->nullable();
            $table->string('page_visited')->nullable();
            $table->string('referrer')->nullable();
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');
            $table->enum('gender', ['male', 'female', 'unknown'])->default('unknown');
            $table->timestamps();
            
            $table->index(['ip_address', 'created_at']);
            $table->index('country_code');
            $table->index('gender');
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visitors');
    }
};
