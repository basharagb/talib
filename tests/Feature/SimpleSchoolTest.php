<?php

namespace Tests\Feature;

use App\Models\EducationalStage;
use App\Models\StudentType;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SimpleSchoolTest extends TestCase
{
    use RefreshDatabase;

    public function test_educational_stages_exist(): void
    {
        $this->artisan('db:seed', ['--class' => 'EducationalStageSeeder']);
        $stages = EducationalStage::all();
        $this->assertGreaterThan(0, $stages->count());
        
        $stageNames = $stages->pluck('name_ar')->toArray();
        $this->assertContains('ابتدائي', $stageNames);
        $this->assertContains('أساسي', $stageNames);
        $this->assertContains('ثانوي', $stageNames);
    }

    public function test_student_types_exist(): void
    {
        $this->artisan('db:seed', ['--class' => 'StudentTypeSeeder']);
        $types = StudentType::all();
        $this->assertGreaterThan(0, $types->count());
        
        $typeNames = $types->pluck('name_ar')->toArray();
        $this->assertContains('ذكور', $typeNames);
        $this->assertContains('إناث', $typeNames);
        $this->assertContains('مختلط', $typeNames);
    }

    public function test_school_registration_page_loads(): void
    {
        $this->artisan('db:seed', ['--class' => 'CountrySeeder']);
        $this->artisan('db:seed', ['--class' => 'EducationalStageSeeder']);
        $this->artisan('db:seed', ['--class' => 'StudentTypeSeeder']);
        
        $response = $this->get('/register/school');
        $response->assertStatus(200);
    }
}
