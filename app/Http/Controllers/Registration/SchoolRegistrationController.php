<?php

namespace App\Http\Controllers\Registration;

use App\Http\Controllers\Controller;
use App\Http\Requests\SchoolRegistrationRequest;
use App\Models\School;
use App\Models\User;
use App\Models\Country;
use App\Models\City;
use App\Models\Grade;
use App\Models\EducationalStage;
use App\Models\StudentType;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class SchoolRegistrationController extends Controller
{
    public function showRegistrationForm()
    {
        $countries = Country::all();
        $grades = Grade::all();
        $educationalStages = EducationalStage::where('is_active', true)->get();
        $studentTypes = StudentType::where('is_active', true)->get();
        
        return view('registration.school', compact('countries', 'grades', 'educationalStages', 'studentTypes'));
    }

    public function register(SchoolRegistrationRequest $request)
    {
        try {
            DB::beginTransaction();

            // Create user account
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'phone' => $request->phone,
                'role' => 'school',
            ]);

            // Create school profile
            $school = School::create([
                'user_id' => $user->id,
                'country_id' => $request->country_id,
                'city_id' => $request->city_id,
                'district' => $request->district,
                'location' => $request->location,
                'description' => $request->description,
                'social_links' => $this->prepareSocialLinks($request),
                'subscription_fee' => 50, // 50 JD per year
            ]);

            // Handle logo upload
            if ($request->hasFile('logo')) {
                $logoPath = $request->file('logo')->store('schools/logos', 'public');
                $school->update(['logo' => $logoPath]);
            }

            // Attach selected grades
            if ($request->has('grades')) {
                $school->grades()->attach($request->grades);
            }

            // Attach selected educational stages
            if ($request->has('educational_stages')) {
                $school->educationalStages()->attach($request->educational_stages);
            }

            // Attach selected student types
            if ($request->has('student_types')) {
                $school->studentTypes()->attach($request->student_types);
            }

            // Create subscription record
            Subscription::create([
                'user_id' => $user->id,
                'type' => 'school',
                'amount' => 50,
                'status' => 'pending',
                'expires_at' => now()->addYear(),
            ]);

            DB::commit();

            // Redirect to payment page
            return redirect()->route('payment.show', ['subscription' => $user->subscription->id])
                           ->with('success', __('Registration completed successfully. Please complete payment to activate your account.'));

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => __('Registration failed. Please try again.')])->withInput();
        }
    }

    public function getCities(Request $request)
    {
        $cities = City::where('country_id', $request->country_id)->get();
        return response()->json($cities);
    }

    private function prepareSocialLinks(Request $request): array
    {
        $socialLinks = [];
        
        if ($request->facebook) {
            $socialLinks['facebook'] = $request->facebook;
        }
        
        if ($request->twitter) {
            $socialLinks['twitter'] = $request->twitter;
        }
        
        if ($request->instagram) {
            $socialLinks['instagram'] = $request->instagram;
        }
        
        if ($request->linkedin) {
            $socialLinks['linkedin'] = $request->linkedin;
        }
        
        if ($request->whatsapp) {
            $socialLinks['whatsapp'] = $request->whatsapp;
        }

        return $socialLinks;
    }
}
