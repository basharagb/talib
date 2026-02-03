<?php

namespace App\Http\Controllers\Registration;

use App\Http\Controllers\Controller;
use App\Http\Requests\KindergartenRegistrationRequest;
use App\Models\Kindergarten;
use App\Models\User;
use App\Models\Country;
use App\Models\City;
use App\Models\Grade;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class KindergartenRegistrationController extends Controller
{
    public function showRegistrationForm()
    {
        $countries = Country::all();
        $grades = Grade::all();
        
        return view('registration.kindergarten', compact('countries', 'grades'));
    }

    public function register(KindergartenRegistrationRequest $request)
    {
        try {
            DB::beginTransaction();

            // Create user account
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'phone' => $request->phone,
                'role' => 'kindergarten',
                'status' => 'pending',
            ]);

            // Create kindergarten profile
            $kindergarten = Kindergarten::create([
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
                $logoPath = $request->file('logo')->store('kindergartens/logos', 'public');
                $kindergarten->update(['logo' => $logoPath]);
            }

            // Attach selected grades
            if ($request->has('grades')) {
                $kindergarten->grades()->attach($request->grades);
            }

            // Create subscription record
            Subscription::create([
                'user_id' => $user->id,
                'type' => 'kindergarten',
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
            Log::error('Kindergarten Registration Error: ' . $e->getMessage() . ' | Line: ' . $e->getLine() . ' | File: ' . $e->getFile());
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
