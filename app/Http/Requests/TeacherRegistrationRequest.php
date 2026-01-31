<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TeacherRegistrationRequest extends FormRequest
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
            'district' => ['nullable', 'string', 'max:255'],
            'location' => ['nullable', 'string', 'max:500'],
            'degree' => ['required', 'in:diploma,bachelor,master,high_diploma,doctorate'],
            'description' => ['required', 'string', 'min:50'],
            'profile_image' => ['required', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            'cv_file' => ['required', 'file', 'mimes:pdf,doc,docx', 'max:5120'],
            'certificates' => ['required', 'array', 'min:1'],
            'certificates.*' => ['file', 'mimes:pdf,jpg,jpeg,png', 'max:5120'],
            'gender' => ['required', 'in:male,female'],
            'experience' => ['required', 'string', 'min:20'],
            'subjects' => ['required', 'array', 'min:1'],
            'subjects.*' => ['exists:subjects,id'],
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
            'name.required' => __('Name is required'),
            'email.required' => __('Email is required'),
            'email.unique' => __('This email is already registered'),
            'password.required' => __('Password is required'),
            'password.min' => __('Password must be at least 8 characters'),
            'password.confirmed' => __('Password confirmation does not match'),
            'phone.required' => __('Phone number is required'),
            'country_id.required' => __('Country is required'),
            'city_id.required' => __('City is required'),
            'degree.required' => __('Academic degree is required'),
            'description.required' => __('Description is required'),
            'description.min' => __('Description must be at least 50 characters'),
            'gender.required' => __('Gender is required'),
            'experience.required' => __('Work experience is required'),
            'experience.min' => __('Work experience must be at least 20 characters'),
            'subjects.required' => __('At least one subject must be selected'),
            'profile_image.required' => __('Profile photo is required'),
            'profile_image.image' => __('Profile image must be a valid image file'),
            'profile_image.max' => __('Profile image size must not exceed 2MB'),
            'cv_file.required' => __('CV file is required'),
            'cv_file.mimes' => __('CV must be a PDF or Word document'),
            'cv_file.max' => __('CV file size must not exceed 5MB'),
            'certificates.required' => __('At least one certificate is required'),
            'certificates.min' => __('At least one certificate must be uploaded'),
            'certificates.*.mimes' => __('Certificates must be PDF or image files'),
            'certificates.*.max' => __('Each certificate size must not exceed 5MB'),
        ];
    }
}
