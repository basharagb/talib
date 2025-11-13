@extends('registration.base')

@section('title', __('School Registration'))

@section('content')
<div class="max-w-4xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
    <div class="bg-white shadow-xl rounded-lg overflow-hidden">
        <div class="bg-gradient-to-r from-green-600 to-blue-600 px-6 py-8">
            <h2 class="text-3xl font-bold text-white text-center">
                {{ __('Private School Registration') }}
            </h2>
            <p class="text-green-100 text-center mt-2">
                {{ __('Annual subscription fee: 50 JD') }}
            </p>
        </div>

        <form method="POST" action="{{ route('register.school.store') }}" enctype="multipart/form-data" class="p-6 space-y-6">
            @csrf

            <!-- Basic Information -->
            <div class="bg-gray-50 p-6 rounded-lg">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">{{ __('Basic Information') }}</h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- School Name -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                            {{ __('School Name') }} <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="name" name="name" value="{{ old('name') }}" required
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent">
                        @error('name')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                            {{ __('Email Address') }} <span class="text-red-500">*</span>
                        </label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" required
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent">
                        @error('email')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                            {{ __('Password') }} <span class="text-red-500">*</span>
                        </label>
                        <input type="password" id="password" name="password" required
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent">
                        @error('password')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Confirm Password -->
                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">
                            {{ __('Confirm Password') }} <span class="text-red-500">*</span>
                        </label>
                        <input type="password" id="password_confirmation" name="password_confirmation" required
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent">
                    </div>

                    <!-- Phone -->
                    <div>
                        <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">
                            {{ __('Phone Number') }} <span class="text-red-500">*</span>
                        </label>
                        <input type="tel" id="phone" name="phone" value="{{ old('phone') }}" required
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent">
                        @error('phone')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Location Information -->
            <div class="bg-gray-50 p-6 rounded-lg">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">{{ __('Location Information') }}</h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Country -->
                    <div>
                        <label for="country_id" class="block text-sm font-medium text-gray-700 mb-2">
                            {{ __('Country') }} <span class="text-red-500">*</span>
                        </label>
                        <select id="country_id" name="country_id" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent">
                            <option value="">{{ __('Select Country') }}</option>
                            @foreach($countries as $country)
                                <option value="{{ $country->id }}" {{ old('country_id') == $country->id ? 'selected' : '' }}>
                                    {{ app()->getLocale() == 'ar' ? $country->name_ar : $country->name_en }}
                                </option>
                            @endforeach
                        </select>
                        @error('country_id')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- City -->
                    <div>
                        <label for="city_id" class="block text-sm font-medium text-gray-700 mb-2">
                            {{ __('City') }} <span class="text-red-500">*</span>
                        </label>
                        <select id="city_id" name="city_id" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent">
                            <option value="">{{ __('Select City') }}</option>
                        </select>
                        @error('city_id')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- District -->
                    <div>
                        <label for="district" class="block text-sm font-medium text-gray-700 mb-2">
                            {{ __('District/Area') }} <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="district" name="district" value="{{ old('district') }}" required
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent">
                        @error('district')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Location -->
                    <div>
                        <label for="location" class="block text-sm font-medium text-gray-700 mb-2">
                            {{ __('Exact Location') }} <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="location" name="location" value="{{ old('location') }}" required
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent">
                        @error('location')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- School Details -->
            <div class="bg-gray-50 p-6 rounded-lg">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">{{ __('School Details') }}</h3>
                
                <!-- Description -->
                <div class="mb-6">
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                        {{ __('Full Description') }} <span class="text-red-500">*</span>
                    </label>
                    <textarea id="description" name="description" rows="4" required
                              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent">{{ old('description') }}</textarea>
                    @error('description')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Logo -->
                <div class="mb-6">
                    <label for="logo" class="block text-sm font-medium text-gray-700 mb-2">
                        {{ __('School Logo') }}
                    </label>
                    <input type="file" id="logo" name="logo" accept="image/*"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent">
                    @error('logo')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Grades -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        {{ __('Grades Taught') }} <span class="text-red-500">*</span>
                    </label>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-3 max-h-48 overflow-y-auto border border-gray-300 rounded-lg p-4">
                        @foreach($grades as $grade)
                            <label class="flex items-center space-x-2 rtl:space-x-reverse">
                                <input type="checkbox" name="grades[]" value="{{ $grade->id }}"
                                       {{ in_array($grade->id, old('grades', [])) ? 'checked' : '' }}
                                       class="rounded border-gray-300 text-green-600 focus:ring-green-500">
                                <span class="text-sm text-gray-700">
                                    {{ app()->getLocale() == 'ar' ? $grade->name_ar : $grade->name_en }}
                                </span>
                            </label>
                        @endforeach
                    </div>
                    @error('grades')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Educational Stages -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        {{ __('Educational Stages') }} <span class="text-red-500">*</span>
                    </label>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                        @foreach($educationalStages as $stage)
                            <label class="flex items-center space-x-2 rtl:space-x-reverse p-3 border border-gray-300 rounded-lg hover:bg-gray-50">
                                <input type="checkbox" name="educational_stages[]" value="{{ $stage->id }}"
                                       {{ in_array($stage->id, old('educational_stages', [])) ? 'checked' : '' }}
                                       class="rounded border-gray-300 text-green-600 focus:ring-green-500">
                                <span class="text-sm text-gray-700 font-medium">
                                    {{ app()->getLocale() == 'ar' ? $stage->name_ar : $stage->name_en }}
                                </span>
                            </label>
                        @endforeach
                    </div>
                    @error('educational_stages')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Student Types -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        {{ __('Student Type') }} <span class="text-red-500">*</span>
                    </label>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                        @foreach($studentTypes as $type)
                            <label class="flex items-center space-x-2 rtl:space-x-reverse p-3 border border-gray-300 rounded-lg hover:bg-gray-50">
                                <input type="checkbox" name="student_types[]" value="{{ $type->id }}"
                                       {{ in_array($type->id, old('student_types', [])) ? 'checked' : '' }}
                                       class="rounded border-gray-300 text-green-600 focus:ring-green-500">
                                <span class="text-sm text-gray-700 font-medium">
                                    {{ app()->getLocale() == 'ar' ? $type->name_ar : $type->name_en }}
                                </span>
                            </label>
                        @endforeach
                    </div>
                    @error('student_types')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Social Media Links -->
            <div class="bg-gray-50 p-6 rounded-lg">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">{{ __('Social Media & Contact') }}</h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="facebook" class="block text-sm font-medium text-gray-700 mb-2">{{ __('Facebook') }}</label>
                        <input type="url" id="facebook" name="facebook" value="{{ old('facebook') }}"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent">
                    </div>

                    <div>
                        <label for="twitter" class="block text-sm font-medium text-gray-700 mb-2">{{ __('Twitter') }}</label>
                        <input type="url" id="twitter" name="twitter" value="{{ old('twitter') }}"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent">
                    </div>

                    <div>
                        <label for="instagram" class="block text-sm font-medium text-gray-700 mb-2">{{ __('Instagram') }}</label>
                        <input type="url" id="instagram" name="instagram" value="{{ old('instagram') }}"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent">
                    </div>

                    <div>
                        <label for="whatsapp" class="block text-sm font-medium text-gray-700 mb-2">{{ __('WhatsApp') }}</label>
                        <input type="tel" id="whatsapp" name="whatsapp" value="{{ old('whatsapp') }}"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent">
                    </div>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="flex justify-center pt-6">
                <button type="submit" 
                        class="bg-gradient-to-r from-green-600 to-blue-600 text-white px-8 py-3 rounded-lg font-semibold hover:from-green-700 hover:to-blue-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transform transition hover:scale-105">
                    {{ __('Register & Proceed to Payment') }}
                </button>
            </div>
        </form>
    </div>
</div>

<script>
document.getElementById('country_id').addEventListener('change', function() {
    const countryId = this.value;
    const citySelect = document.getElementById('city_id');
    
    // Clear existing options
    citySelect.innerHTML = '<option value="">{{ __("Select City") }}</option>';
    
    if (countryId) {
        fetch(`{{ route('register.cities', '') }}/${countryId}`)
            .then(response => response.json())
            .then(cities => {
                cities.forEach(city => {
                    const option = document.createElement('option');
                    option.value = city.id;
                    option.textContent = '{{ app()->getLocale() }}' === 'ar' ? city.name_ar : city.name_en;
                    citySelect.appendChild(option);
                });
            })
            .catch(error => console.error('Error:', error));
    }
});
</script>
@endsection
