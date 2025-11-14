<?php
/**
 * Migration to add rejected status to users table.
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
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        DB::statement(
            "ALTER TABLE users MODIFY COLUMN status " .
            "ENUM('pending', 'active', 'suspended', 'rejected') " .
            "NOT NULL DEFAULT 'pending'"
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        DB::statement(
            "ALTER TABLE users MODIFY COLUMN status " .
            "ENUM('pending', 'active', 'suspended') " .
            "NOT NULL DEFAULT 'pending'"
        );
    }
};
