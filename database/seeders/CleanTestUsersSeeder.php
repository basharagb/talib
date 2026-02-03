<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Teacher;
use App\Models\School;
use App\Models\Kindergarten;
use App\Models\Nursery;
use App\Models\EducationalCenter;
use App\Models\Subscription;
use Illuminate\Support\Facades\DB;

class CleanTestUsersSeeder extends Seeder
{
    /**
     * Delete all test users except admin users.
     */
    public function run(): void
    {
        $this->command->info('Cleaning test users (keeping admins)...');

        // Get admin user IDs to exclude
        $adminIds = User::where('role', 'admin')
            ->orWhere('email', 'like', '%admin%')
            ->pluck('id')
            ->toArray();

        $this->command->info('Found ' . count($adminIds) . ' admin user(s) to keep.');

        // Get non-admin users
        $usersToDelete = User::whereNotIn('id', $adminIds)->get();

        $this->command->info('Found ' . $usersToDelete->count() . ' test user(s) to delete.');

        DB::beginTransaction();

        try {
            foreach ($usersToDelete as $user) {
                // Delete related records first
                Teacher::where('user_id', $user->id)->delete();
                School::where('user_id', $user->id)->delete();
                Kindergarten::where('user_id', $user->id)->delete();
                Nursery::where('user_id', $user->id)->delete();
                EducationalCenter::where('user_id', $user->id)->delete();
                Subscription::where('user_id', $user->id)->delete();

                $this->command->info("Deleted user: {$user->email}");
                
                // Delete the user
                $user->delete();
            }

            DB::commit();
            $this->command->info('✓ Successfully cleaned ' . $usersToDelete->count() . ' test users.');

        } catch (\Exception $e) {
            DB::rollBack();
            $this->command->error('Error: ' . $e->getMessage());
        }
    }
}
