@extends('registration.base')

@section('title', __('Teacher Registration'))

@section('page-title', __('Teacher Registration'))

@section('page-description', __('Join our platform as a teacher. Annual subscription: 10 JD'))

@section('form-content')
<form method="POST" action="{{ route('register.teacher.store') }}" enctype="multipart/form-data" class="space-y-6">
    @csrf
    
    <!-- Basic Information -->
    <div class="form-section p-6 mb-8">
        <div class="flex items-center mb-6">
            <div class="w-10 h-10 bg-gradient-to-r from-blue-500 to-purple-500 rounded-full flex items-center justify-center mr-4">
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                </svg>
            </div>
            <h3 class="text-2xl font-bold text-gray-900">{{ __('Basic Information') }}</h3>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Name -->
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                    {{ __('Full Name') }} <span class="text-red-500">*</span>
                </label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" required
                       class="form-input w-full px-4 py-3 focus:outline-none transition-all duration-300">
                @error('name')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            
            <!-- Email -->
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                    {{ __('Email Address') }} <span class="text-red-500">*</span>
                </label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required
                       class="form-input w-full px-4 py-3 focus:outline-none transition-all duration-300">
                @error('email')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            
            <!-- Phone -->
            <div>
                <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">
                    {{ __('Phone Number') }} <span class="text-red-500">*</span>
                </label>
                <input type="tel" id="phone" name="phone" value="{{ old('phone') }}" required
                       class="form-input w-full px-4 py-3 focus:outline-none transition-all duration-300">
                @error('phone')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            
            <!-- Gender -->
            <div>
                <label for="gender" class="block text-sm font-medium text-gray-700 mb-2">
                    {{ __('Gender') }} <span class="text-red-500">*</span>
                </label>
                <select id="gender" name="gender" required
                        class="form-input w-full px-4 py-3 focus:outline-none transition-all duration-300">
                    <option value="">{{ __('Select Gender') }}</option>
                    <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>{{ __('Male') }}</option>
                    <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>{{ __('Female') }}</option>
                </select>
                @error('gender')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            
            <!-- Password -->
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                    {{ __('Password') }} <span class="text-red-500">*</span>
                </label>
                <input type="password" id="password" name="password" required
                       class="form-input w-full px-4 py-3 focus:outline-none transition-all duration-300">
                @error('password')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            
            <!-- Confirm Password -->
            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">
                    {{ __('Confirm Password') }} <span class="text-red-500">*</span>
                </label>
                <input type="password" id="password_confirmation" name="password_confirmation" required
                       class="form-input w-full px-4 py-3 focus:outline-none transition-all duration-300">
            </div>
        </div>
    </div>
    
    <!-- Location Information -->
    <div class="form-section p-6 mb-8">
        <div class="flex items-center mb-6">
            <div class="w-10 h-10 bg-gradient-to-r from-green-500 to-teal-500 rounded-full flex items-center justify-center mr-4">
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                </svg>
            </div>
            <h3 class="text-2xl font-bold text-gray-900">{{ __('Location Information') }}</h3>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Country -->
            <div>
                <label for="country_id" class="block text-sm font-medium text-gray-700 mb-2">
                    {{ __('Country') }} <span class="text-red-500">*</span>
                </label>
                <select id="country_id" name="country_id" required onchange="loadCities(this.value, 'city_id')"
                        class="form-input w-full px-4 py-3 focus:outline-none transition-all duration-300">
                    <option value="">{{ __('Select Country') }}</option>
                    @foreach($countries as $country)
                        <option value="{{ $country->id }}" {{ old('country_id') == $country->id ? 'selected' : '' }}>
                            {{ $country->{'name_' . app()->getLocale()} }}
                        </option>
                    @endforeach
                </select>
                @error('country_id')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            
            <!-- City -->
            <div>
                <label for="city_id" class="block text-sm font-medium text-gray-700 mb-2">
                    {{ __('City') }} <span class="text-red-500">*</span>
                </label>
                <select id="city_id" name="city_id" required
                        class="form-input w-full px-4 py-3 focus:outline-none transition-all duration-300">
                    <option value="">{{ __('Select City') }}</option>
                </select>
                @error('city_id')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            
            <!-- District -->
            <div>
                <label for="district" class="block text-sm font-medium text-gray-700 mb-2">
                    {{ __('District/Area') }}
                </label>
                <input type="text" id="district" name="district" value="{{ old('district') }}"
                       class="form-input w-full px-4 py-3 focus:outline-none transition-all duration-300">
                @error('district')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            
            <!-- Location -->
            <div>
                <label for="location" class="block text-sm font-medium text-gray-700 mb-2">
                    {{ __('Detailed Location') }}
                </label>
                <input type="text" id="location" name="location" value="{{ old('location') }}"
                       class="form-input w-full px-4 py-3 focus:outline-none transition-all duration-300">
                @error('location')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>
    </div>
    
    <!-- Professional Information -->
    <div class="form-section p-6 mb-8">
        <div class="flex items-center mb-6">
            <div class="w-10 h-10 bg-gradient-to-r from-purple-500 to-indigo-500 rounded-full flex items-center justify-center mr-4">
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
                </svg>
            </div>
            <h3 class="text-2xl font-bold text-gray-900">{{ __('Professional Information') }}</h3>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Academic Degree -->
            <div>
                <label for="degree" class="block text-sm font-medium text-gray-700 mb-2">
                    {{ __('Academic Degree') }} <span class="text-red-500">*</span>
                </label>
                <select id="degree" name="degree" required
                        class="form-input w-full px-4 py-3 focus:outline-none transition-all duration-300">
                    <option value="">{{ __('Select Degree') }}</option>
                    <option value="diploma" {{ old('degree') == 'diploma' ? 'selected' : '' }}>{{ __('Diploma') }}</option>
                    <option value="bachelor" {{ old('degree') == 'bachelor' ? 'selected' : '' }}>{{ __('Bachelor') }}</option>
                    <option value="master" {{ old('degree') == 'master' ? 'selected' : '' }}>{{ __('Master') }}</option>
                    <option value="high_diploma" {{ old('degree') == 'high_diploma' ? 'selected' : '' }}>{{ __('High Diploma') }}</option>
                    <option value="doctorate" {{ old('degree') == 'doctorate' ? 'selected' : '' }}>{{ __('Doctorate') }}</option>
                </select>
                @error('degree')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            
            <!-- Profile Image -->
            <div>
                <label for="profile_image" class="block text-sm font-medium text-gray-700 mb-2">
                    {{ __('Profile Photo') }}
                </label>
                <input type="file" id="profile_image" name="profile_image" accept="image/*" onchange="previewImage(this, 'profile_preview')"
                       class="form-input w-full px-4 py-3 focus:outline-none transition-all duration-300">
                <img id="profile_preview" class="mt-2 h-20 w-20 object-cover rounded-full hidden" alt="Profile Preview">
                @error('profile_image')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>
        
        <!-- Description -->
        <div class="mt-6">
            <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                {{ __('Full Description About Yourself') }} <span class="text-red-500">*</span>
            </label>
            <textarea id="description" name="description" rows="4" required
                      class="form-input w-full px-4 py-3 focus:outline-none transition-all duration-300">{{ old('description') }}</textarea>
            @error('description')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>
        
        <!-- Work Experience -->
        <div class="mt-6">
            <label for="experience" class="block text-sm font-medium text-gray-700 mb-2">
                {{ __('Work Experience') }} <span class="text-red-500">*</span>
            </label>
            <textarea id="experience" name="experience" rows="4" required
                      class="form-input w-full px-4 py-3 focus:outline-none transition-all duration-300">{{ old('experience') }}</textarea>
            @error('experience')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>
        
        <!-- Subjects -->
        <div class="mt-6">
            <label class="block text-sm font-medium text-gray-700 mb-2">
                {{ __('Subjects You Teach') }} <span class="text-red-500">*</span>
            </label>
            <div class="grid grid-cols-2 md:grid-cols-3 gap-3 max-h-40 overflow-y-auto border border-gray-300 rounded-md p-3">
                @foreach($subjects as $subject)
                    <label class="flex items-center">
                        <input type="checkbox" name="subjects[]" value="{{ $subject->id }}" 
                               {{ in_array($subject->id, old('subjects', [])) ? 'checked' : '' }}
                               class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                        <span class="ml-2 rtl:ml-0 rtl:mr-2 text-sm text-gray-700">
                            {{ $subject->{'name_' . app()->getLocale()} }}
                        </span>
                    </label>
                @endforeach
            </div>
            @error('subjects')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>
    </div>
    
    <!-- Contact Information -->
    <div class="form-section p-6 mb-8">
        <div class="flex items-center mb-6">
            <div class="w-10 h-10 bg-gradient-to-r from-pink-500 to-rose-500 rounded-full flex items-center justify-center mr-4">
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                </svg>
            </div>
            <h3 class="text-2xl font-bold text-gray-900">{{ __('Contact & Social Media') }}</h3>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Facebook -->
            <div>
                <label for="facebook" class="block text-sm font-medium text-gray-700 mb-2">
                    {{ __('Facebook Profile') }}
                </label>
                <input type="url" id="facebook" name="facebook" value="{{ old('facebook') }}"
                       class="form-input w-full px-4 py-3 focus:outline-none transition-all duration-300">
                @error('facebook')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            
            <!-- Twitter -->
            <div>
                <label for="twitter" class="block text-sm font-medium text-gray-700 mb-2">
                    {{ __('Twitter Profile') }}
                </label>
                <input type="url" id="twitter" name="twitter" value="{{ old('twitter') }}"
                       class="form-input w-full px-4 py-3 focus:outline-none transition-all duration-300">
                @error('twitter')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            
            <!-- Instagram -->
            <div>
                <label for="instagram" class="block text-sm font-medium text-gray-700 mb-2">
                    {{ __('Instagram Profile') }}
                </label>
                <input type="url" id="instagram" name="instagram" value="{{ old('instagram') }}"
                       class="form-input w-full px-4 py-3 focus:outline-none transition-all duration-300">
                @error('instagram')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            
            <!-- LinkedIn -->
            <div>
                <label for="linkedin" class="block text-sm font-medium text-gray-700 mb-2">
                    {{ __('LinkedIn Profile') }}
                </label>
                <input type="url" id="linkedin" name="linkedin" value="{{ old('linkedin') }}"
                       class="form-input w-full px-4 py-3 focus:outline-none transition-all duration-300">
                @error('linkedin')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            
            <!-- WhatsApp -->
            <div>
                <label for="whatsapp" class="block text-sm font-medium text-gray-700 mb-2">
                    {{ __('WhatsApp Number') }}
                </label>
                <input type="text" id="whatsapp" name="whatsapp" value="{{ old('whatsapp') }}"
                       class="form-input w-full px-4 py-3 focus:outline-none transition-all duration-300">
                @error('whatsapp')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>
    </div>
    
    <!-- Subscription Information -->
    <div class="form-section p-8 mb-8 bg-gradient-to-r from-blue-50 to-indigo-50 border-2 border-blue-200">
        <div class="flex items-center mb-6">
            <div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-indigo-500 rounded-full flex items-center justify-center mr-4 animate-pulse">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
            <h3 class="text-2xl font-bold text-blue-900">{{ __('Subscription Information') }}</h3>
        </div>
        <p class="text-blue-700 mb-4">
            {{ __('Annual subscription fee: 10 JD') }}
        </p>
        <p class="text-sm text-blue-600">
            {{ __('After completing registration, you will be redirected to the payment page to activate your account.') }}
        </p>
    </div>
    
    <!-- Submit Button -->
    <div class="flex justify-center">
        <button type="submit" 
                class="btn-primary text-white font-bold py-4 px-12 text-lg shadow-2xl focus:outline-none focus:ring-4 focus:ring-purple-300 transform hover:scale-105 transition-all duration-300">
            <span class="flex items-center space-x-2 rtl:space-x-reverse">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <span>{{ __('Register & Proceed to Payment') }}</span>
            </span>
        </button>
    </div>
</form>
@endsection
