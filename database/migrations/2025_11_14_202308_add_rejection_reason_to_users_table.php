<?php
/**
 * Migration to add rejection reason column to users table.
 *
 * PHP version 8.4
 *
 * @category Database
 * @package  Talib
 * @author   Talib Platform <info@talib.com>
 * @license  MIT License
 * @version  GIT: <git_id>
 * @link     http://talib.com
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->text('rejection_reason')->nullable()->after('status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('rejection_reason');
        });
    }
};
