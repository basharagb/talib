<?php

namespace App\Http\Controllers\Registration;

use App\Http\Controllers\Controller;
use App\Http\Requests\NurseryRegistrationRequest;
use App\Models\Nursery;
use App\Models\User;
use App\Models\Country;
use App\Models\City;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class NurseryRegistrationController extends Controller
{
    public function showRegistrationForm()
    {
        $countries = Country::all();
        
        return view('registration.nursery', compact('countries'));
    }

    public function register(NurseryRegistrationRequest $request)
    {
        try {
            DB::beginTransaction();

            // Create user account
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'phone' => $request->phone,
                'role' => 'nursery',
                'status' => 'pending',
            ]);

            // Create nursery profile
            $nursery = Nursery::create([
                'user_id' => $user->id,
                'country_id' => $request->country_id,
                'city_id' => $request->city_id,
                'district' => $request->district,
                'location' => $request->location,
                'description' => $request->description,
                'social_links' => $this->prepareSocialLinks($request),
                'ages_accepted' => $request->age_ranges ? json_encode($request->age_ranges) : null,
                'subscription_fee' => 40, // 40 JD per year
            ]);

            // Handle logo upload
            if ($request->hasFile('logo')) {
                $logoPath = $request->file('logo')->store('nurseries/logos', 'public');
                $nursery->update(['logo' => $logoPath]);
            }

            // Create subscription record
            Subscription::create([
                'user_id' => $user->id,
                'type' => 'nursery',
                'amount' => 40,
                'status' => 'pending',
                'expires_at' => now()->addYear(),
            ]);

            DB::commit();

            // Redirect to payment page
            return redirect()->route('payment.show', ['subscription' => $user->subscription->id])
                           ->with('success', __('Registration completed successfully. Please complete payment to activate your account.'));

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Nursery Registration Error: ' . $e->getMessage() . ' | Line: ' . $e->getLine() . ' | File: ' . $e->getFile());
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

    private function getAgeOptions(): array
    {
        $ages = [];
        
        // Days (1-30)
        for ($i = 1; $i <= 30; $i++) {
            $ages[] = ['value' => "{$i}_days", 'label_ar' => "{$i} يوم", 'label_en' => "{$i} days"];
        }
        
        // Months (1-11)
        for ($i = 1; $i <= 11; $i++) {
            $ages[] = ['value' => "{$i}_months", 'label_ar' => "{$i} شهر", 'label_en' => "{$i} months"];
        }
        
        // Years (1-5)
        for ($i = 1; $i <= 5; $i++) {
            $ages[] = ['value' => "{$i}_years", 'label_ar' => "{$i} سنة", 'label_en' => "{$i} years"];
        }
        
        return $ages;
    }
}
