<?php

namespace App\Http\Controllers\Registration;

use App\Http\Controllers\Controller;
use App\Http\Requests\TeacherRegistrationRequest;
use App\Models\Teacher;
use App\Models\User;
use App\Models\Country;
use App\Models\City;
use App\Models\Subject;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class TeacherRegistrationController extends Controller
{
    public function showRegistrationForm()
    {
        $countries = Country::all();
        $subjects = Subject::all();
        
        return view('registration.teacher', compact('countries', 'subjects'));
    }

    public function register(TeacherRegistrationRequest $request)
    {
        try {
            DB::beginTransaction();

            // Create user account
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'phone' => $request->phone,
                'role' => 'teacher',
                'status' => 'pending',
            ]);

            // Create teacher profile
            $teacher = Teacher::create([
                'user_id' => $user->id,
                'country_id' => $request->country_id,
                'city_id' => $request->city_id,
                'district' => $request->district,
                'location' => $request->location,
                'degree' => $request->degree,
                'description' => $request->description,
                'gender' => $request->gender,
                'social_links' => $this->prepareSocialLinks($request),
                'experience' => $request->experience,
                'subscription_fee' => 10, // 10 JD per year
            ]);

            // Handle profile image upload
            if ($request->hasFile('profile_image')) {
                $imagePath = $request->file('profile_image')->store('teachers/profiles', 'public');
                $teacher->update(['profile_image' => $imagePath]);
            }

            // Handle CV file upload
            if ($request->hasFile('cv_file')) {
                $cvPath = $request->file('cv_file')->store('teachers/cvs', 'public');
                $teacher->update(['cv_file' => $cvPath]);
            }

            // Handle certificates upload
            if ($request->hasFile('certificates')) {
                $certificatePaths = [];
                foreach ($request->file('certificates') as $certificate) {
                    $certificatePaths[] = $certificate->store('teachers/certificates', 'public');
                }
                $teacher->update(['certificates' => $certificatePaths]);
            }

            // Attach selected subjects
            if ($request->has('subjects')) {
                $teacher->subjects()->attach($request->subjects);
            }

            // Create subscription record
            Subscription::create([
                'user_id' => $user->id,
                'subscription_type' => 'teacher',
                'amount' => 10,
                'status' => 'pending',
                'start_date' => now(),
                'end_date' => now()->addYear(),
            ]);

            DB::commit();

            // Redirect to payment page
            return redirect()->route('payment.show', ['subscription' => $user->subscription->id])
                           ->with('success', __('Registration completed successfully. Please complete payment to activate your account.'));

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Teacher Registration Error: ' . $e->getMessage() . ' | Line: ' . $e->getLine() . ' | File: ' . $e->getFile());
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
