<?php

namespace Tests\Unit;

use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserRoleTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_be_teacher(): void
    {
        $user = User::factory()->create(['role' => 'teacher']);
        
        $this->assertTrue($user->isTeacher());
        $this->assertFalse($user->isStudent());
    }

    public function test_user_can_be_educational_center(): void
    {
        $user = User::factory()->create(['role' => 'educational_center']);
        
        $this->assertTrue($user->isEducationalCenter());
        $this->assertFalse($user->isTeacher());
    }

    public function test_user_can_be_student(): void
    {
        $user = User::factory()->create(['role' => 'student']);
        
        $this->assertTrue($user->isStudent());
        $this->assertFalse($user->isTeacher());
    }

    public function test_user_role_methods_work_correctly(): void
    {
        $roles = ['teacher', 'educational_center', 'school', 'kindergarten', 'nursery', 'student'];
        
        foreach ($roles as $role) {
            $user = User::factory()->create(['role' => $role]);
            
            // Test that the correct role method returns true
            $methodName = 'is' . str_replace('_', '', ucwords($role, '_'));
            if ($role === 'educational_center') {
                $methodName = 'isEducationalCenter';
            }
            
            $this->assertTrue($user->$methodName(), "User with role {$role} should return true for {$methodName}()");
        }
    }
}
