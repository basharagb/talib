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
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;

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
                'status' => 'pending',
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
            $subscription = Subscription::create([
                'user_id' => $user->id,
                'subscription_type' => 'school',
                'amount' => 50.00,
                'status' => 'pending',
                'start_date' => Carbon::now(),
                'end_date' => Carbon::now()->addYear(),
            ]);

            DB::commit();

            // Auto-login the user after registration
            Auth::login($user);
            
            // Regenerate session for security
            request()->session()->regenerate();

            // Redirect to payment status page
            return redirect()->route('payment.status', $subscription)
                ->with('success', __('School registration completed successfully! Please proceed to payment.'));

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('School Registration Error: ' . $e->getMessage() . ' | Line: ' . $e->getLine() . ' | File: ' . $e->getFile());
            return back()->withErrors(['error' => __('Registration failed. Please try again.') . ' (' . $e->getMessage() . ')'])->withInput();
        }
    }

    public function getCities($country)
    {
        $cities = City::where('country_id', $country)->get();
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
