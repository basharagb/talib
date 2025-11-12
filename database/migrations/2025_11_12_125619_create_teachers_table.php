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
        Schema::create('teachers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('country_id')->constrained();
            $table->foreignId('city_id')->constrained();
            $table->string('district')->nullable();
            $table->string('location')->nullable();
            $table->enum('degree', ['diploma', 'bachelor', 'master', 'high_diploma', 'phd']);
            $table->text('description');
            $table->string('profile_image')->nullable();
            $table->enum('gender', ['male', 'female']);
            $table->json('social_links')->nullable();
            $table->text('experience')->nullable();
            $table->decimal('subscription_fee', 8, 2)->default(10.00);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teachers');
    }
};
