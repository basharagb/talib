<?php

namespace App\Http\Controllers\Registration;

use App\Http\Controllers\Controller;
use App\Http\Requests\EducationalCenterRegistrationRequest;
use App\Models\EducationalCenter;
use App\Models\User;
use App\Models\Country;
use App\Models\City;
use App\Models\Subject;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class EducationalCenterRegistrationController extends Controller
{
    public function showRegistrationForm()
    {
        $countries = Country::all();
        $subjects = Subject::all();
        
        return view('registration.educational-center', compact('countries', 'subjects'));
    }

    public function register(EducationalCenterRegistrationRequest $request)
    {
        try {
            DB::beginTransaction();

            // Create user account
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'phone' => $request->phone,
                'role' => 'educational_center',
            ]);

            // Create educational center profile
            $center = EducationalCenter::create([
                'user_id' => $user->id,
                'country_id' => $request->country_id,
                'city_id' => $request->city_id,
                'district' => $request->district,
                'location' => $request->location,
                'description' => $request->description,
                'social_links' => $this->prepareSocialLinks($request),
                'subscription_fee' => 25, // 25 JD per year
            ]);

            // Handle logo upload
            if ($request->hasFile('logo')) {
                $logoPath = $request->file('logo')->store('centers/logos', 'public');
                $center->update(['logo' => $logoPath]);
            }

            // Attach selected subjects
            if ($request->has('subjects')) {
                $center->subjects()->attach($request->subjects);
            }

            // Create subscription record
            Subscription::create([
                'user_id' => $user->id,
                'type' => 'educational_center',
                'amount' => 25,
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
