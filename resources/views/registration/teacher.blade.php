@extends('registration.base')

@section('title', __('Teacher Registration'))

@section('page-title', __('Teacher Registration'))

@section('page-description', __('Join our platform as a teacher. Annual subscription: 10 JD'))

@section('form-content')
<form method="POST" action="{{ route('register.teacher.store') }}" enctype="multipart/form-data" class="space-y-6">
    @csrf
    
    <!-- Basic Information -->
    <div class="border-b border-gray-200 pb-6">
        <h3 class="text-lg font-medium text-gray-900 mb-4">{{ __('Basic Information') }}</h3>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Name -->
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                    {{ __('Full Name') }} <span class="text-red-500">*</span>
                </label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" required
                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
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
                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
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
                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
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
                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
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
                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
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
                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
            </div>
        </div>
    </div>
    
    <!-- Location Information -->
    <div class="border-b border-gray-200 pb-6">
        <h3 class="text-lg font-medium text-gray-900 mb-4">{{ __('Location Information') }}</h3>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Country -->
            <div>
                <label for="country_id" class="block text-sm font-medium text-gray-700 mb-2">
                    {{ __('Country') }} <span class="text-red-500">*</span>
                </label>
                <select id="country_id" name="country_id" required onchange="loadCities(this.value, 'city_id')"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
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
                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
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
                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
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
                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                @error('location')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>
    </div>
    
    <!-- Professional Information -->
    <div class="border-b border-gray-200 pb-6">
        <h3 class="text-lg font-medium text-gray-900 mb-4">{{ __('Professional Information') }}</h3>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Academic Degree -->
            <div>
                <label for="degree" class="block text-sm font-medium text-gray-700 mb-2">
                    {{ __('Academic Degree') }} <span class="text-red-500">*</span>
                </label>
                <select id="degree" name="degree" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
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
                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
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
                      class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">{{ old('description') }}</textarea>
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
                      class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">{{ old('experience') }}</textarea>
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
    <div class="border-b border-gray-200 pb-6">
        <h3 class="text-lg font-medium text-gray-900 mb-4">{{ __('Contact & Social Media') }}</h3>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Facebook -->
            <div>
                <label for="facebook" class="block text-sm font-medium text-gray-700 mb-2">
                    {{ __('Facebook Profile') }}
                </label>
                <input type="url" id="facebook" name="facebook" value="{{ old('facebook') }}"
                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
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
                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
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
                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
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
                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
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
                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                @error('whatsapp')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>
    </div>
    
    <!-- Subscription Information -->
    <div class="bg-blue-50 border border-blue-200 rounded-lg p-6">
        <h3 class="text-lg font-medium text-blue-900 mb-2">{{ __('Subscription Information') }}</h3>
        <p class="text-blue-700 mb-4">
            {{ __('Annual subscription fee: 10 JD') }}
        </p>
        <p class="text-sm text-blue-600">
            {{ __('After completing registration, you will be redirected to the payment page to activate your account.') }}
        </p>
    </div>
    
    <!-- Submit Button -->
    <div class="flex justify-end">
        <button type="submit" 
                class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-3 px-8 rounded-md transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
            {{ __('Register & Proceed to Payment') }}
        </button>
    </div>
</form>
@endsection
