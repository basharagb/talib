<?php

namespace Tests\Feature;

use App\Models\EducationalStage;
use App\Models\StudentType;
use App\Models\School;
use App\Models\User;
use App\Models\Country;
use App\Models\City;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SchoolEnhancementsTest extends TestCase
{
    use RefreshDatabase;

    public function test_educational_stages_are_seeded(): void
    {
        $this->artisan('db:seed', ['--class' => 'EducationalStageSeeder']);
        
        $this->assertDatabaseHas('educational_stages', [
            'name_ar' => 'ابتدائي',
            'name_en' => 'Elementary',
            'slug' => 'elementary'
        ]);
        
        $this->assertDatabaseHas('educational_stages', [
            'name_ar' => 'أساسي',
            'name_en' => 'Basic',
            'slug' => 'basic'
        ]);
        
        $this->assertDatabaseHas('educational_stages', [
            'name_ar' => 'ثانوي',
            'name_en' => 'Secondary',
            'slug' => 'secondary'
        ]);
    }

    public function test_student_types_are_seeded(): void
    {
        $this->artisan('db:seed', ['--class' => 'StudentTypeSeeder']);
        
        $this->assertDatabaseHas('student_types', [
            'name_ar' => 'ذكور',
            'name_en' => 'Boys',
            'slug' => 'boys'
        ]);
        
        $this->assertDatabaseHas('student_types', [
            'name_ar' => 'إناث',
            'name_en' => 'Girls',
            'slug' => 'girls'
        ]);
        
        $this->assertDatabaseHas('student_types', [
            'name_ar' => 'مختلط',
            'name_en' => 'Mixed',
            'slug' => 'mixed'
        ]);
    }

    public function test_school_can_have_educational_stages(): void
    {
        $this->artisan('db:seed', ['--class' => 'CountrySeeder']);
        $this->artisan('db:seed', ['--class' => 'EducationalStageSeeder']);
        
        $user = User::factory()->create(['role' => 'school']);
        $country = Country::first();
        $city = City::create([
            'name_ar' => 'عمان',
            'name_en' => 'Amman',
            'country_id' => $country->id
        ]);
        
        $school = School::create([
            'user_id' => $user->id,
            'country_id' => $country->id,
            'city_id' => $city->id,
            'district' => 'Test District',
            'location' => 'Test Location',
            'description' => 'Test Description',
            'subscription_fee' => 50,
        ]);
        
        $stages = EducationalStage::all();
        $school->educationalStages()->attach($stages->pluck('id'));
        
        $this->assertEquals(3, $school->educationalStages()->count());
        $this->assertTrue($school->educationalStages->contains('slug', 'elementary'));
        $this->assertTrue($school->educationalStages->contains('slug', 'basic'));
        $this->assertTrue($school->educationalStages->contains('slug', 'secondary'));
    }

    public function test_school_can_have_student_types(): void
    {
        $this->artisan('db:seed', ['--class' => 'CountrySeeder']);
        $this->artisan('db:seed', ['--class' => 'StudentTypeSeeder']);
        
        $user = User::factory()->create(['role' => 'school']);
        $country = Country::first();
        $city = City::create([
            'name_ar' => 'عمان',
            'name_en' => 'Amman',
            'country_id' => $country->id
        ]);
        
        $school = School::create([
            'user_id' => $user->id,
            'country_id' => $country->id,
            'city_id' => $city->id,
            'district' => 'Test District',
            'location' => 'Test Location',
            'description' => 'Test Description',
            'subscription_fee' => 50,
        ]);
        
        $types = StudentType::all();
        $school->studentTypes()->attach($types->pluck('id'));
        
        $this->assertEquals(3, $school->studentTypes()->count());
        $this->assertTrue($school->studentTypes->contains('slug', 'boys'));
        $this->assertTrue($school->studentTypes->contains('slug', 'girls'));
        $this->assertTrue($school->studentTypes->contains('slug', 'mixed'));
    }

    public function test_school_registration_form_shows_new_fields()
    {
        $this->artisan('db:seed', ['--class' => 'CountrySeeder']);
        $this->artisan('db:seed', ['--class' => 'EducationalStageSeeder']);
        $this->artisan('db:seed', ['--class' => 'StudentTypeSeeder']);
        
        // Test with English locale
        app()->setLocale('en');
        $response = $this->get('/register/school?lang=en');
        
        $response->assertStatus(200);
        $response->assertSee('Educational Stages');
        $response->assertSee('Student Type');
        $response->assertSee('Elementary');
        $response->assertSee('Boys');
        $response->assertSee('Girls');
        $response->assertSee('Mixed');
    }
}
