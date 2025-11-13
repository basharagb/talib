<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class KindergartenRegistrationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'phone' => ['required', 'string', 'max:20'],
            'country_id' => ['required', 'exists:countries,id'],
            'city_id' => ['required', 'exists:cities,id'],
            'district' => ['required', 'string', 'max:255'],
            'location' => ['required', 'string', 'max:500'],
            'description' => ['required', 'string', 'min:50'],
            'logo' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            'grades' => ['required', 'array', 'min:1'],
            'grades.*' => ['exists:grades,id'],
            'facebook' => ['nullable', 'url'],
            'twitter' => ['nullable', 'url'],
            'instagram' => ['nullable', 'url'],
            'linkedin' => ['nullable', 'url'],
            'whatsapp' => ['nullable', 'string', 'max:20'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => __('Kindergarten name is required'),
            'email.required' => __('Email is required'),
            'email.unique' => __('This email is already registered'),
            'password.required' => __('Password is required'),
            'password.min' => __('Password must be at least 8 characters'),
            'password.confirmed' => __('Password confirmation does not match'),
            'phone.required' => __('Phone number is required'),
            'country_id.required' => __('Country is required'),
            'city_id.required' => __('City is required'),
            'district.required' => __('District is required'),
            'location.required' => __('Location is required'),
            'description.required' => __('Description is required'),
            'description.min' => __('Description must be at least 50 characters'),
            'grades.required' => __('At least one grade must be selected'),
            'logo.image' => __('Logo must be a valid image file'),
            'logo.max' => __('Logo size must not exceed 2MB'),
        ];
    }
}
