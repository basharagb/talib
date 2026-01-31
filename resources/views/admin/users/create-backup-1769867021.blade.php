@extends('layouts.dashboard')

@section('title', __('messages.add_new_user') . ' - ' . config('app.name', 'طالب'))

@section('page-title', __('messages.add_new_user'))

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.users.index') }}">{{ __('messages.user_management') }}</a></li>
    <li class="breadcrumb-item active">{{ __('messages.add_new_user') }}</li>
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ __('messages.user_information') }}</h3>
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('admin.users.store') }}" id="userForm">
                @csrf

                <!-- Basic Information -->
                <div class="row mb-4">
                    <div class="col-12">
                        <h5 class="border-bottom pb-2 mb-3">{{ __('messages.basic_information') }}</h5>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="name" class="form-label">{{ __('messages.name') }} <span
                                class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                            value="{{ old('name') }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="email" class="form-label">{{ __('messages.email') }} <span
                                class="text-danger">*</span></label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                            name="email" value="{{ old('email') }}" required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="password" class="form-label">{{ __('messages.password') }} <span
                                class="text-danger">*</span></label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password"
                            name="password" required>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="password_confirmation" class="form-label">{{ __('messages.confirm_password') }} <span
                                class="text-danger">*</span></label>
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation"
                            required>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="phone" class="form-label">{{ __('messages.phone') }}</label>
                        <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone"
                            value="{{ old('phone') }}">
                        @error('phone')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="role" class="form-label">{{ __('messages.role') }} <span
                                class="text-danger">*</span></label>
                        <select class="form-select @error('role') is-invalid @enderror" id="role" name="role" required
                            onchange="toggleRoleFields()">
                            <option value="">{{ __('messages.select_role') }}</option>
                            <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>{{ __('messages.admin') }}
                            </option>
                            <option value="teacher" {{ old('role') == 'teacher' ? 'selected' : '' }}>
                                {{ __('messages.teacher') }}
                            </option>
                            <option value="educational_center" {{ old('role') == 'educational_center' ? 'selected' : '' }}>
                                {{ __('messages.educational_center') }}
                            </option>
                            <option value="school" {{ old('role') == 'school' ? 'selected' : '' }}>{{ __('messages.school') }}
                            </option>
                            <option value="kindergarten" {{ old('role') == 'kindergarten' ? 'selected' : '' }}>
                                {{ __('messages.kindergarten') }}
                            </option>
                            <option value="nursery" {{ old('role') == 'nursery' ? 'selected' : '' }}>
                                {{ __('messages.nursery') }}
                            </option>
                            <option value="student" {{ old('role') == 'student' ? 'selected' : '' }}>
                                {{ __('messages.student') }}
                            </option>
                        </select>
                        @error('role')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="status" class="form-label">{{ __('messages.status') }} <span
                                class="text-danger">*</span></label>
                        <select class="form-select @error('status') is-invalid @enderror" id="status" name="status"
                            required>
                            <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>
                                {{ __('messages.active') }}
                            </option>
                            <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>
                                {{ __('messages.pending') }}
                            </option>
                            <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>
                                {{ __('messages.inactive') }}
                            </option>
                        </select>
                        @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Location Information (for all roles except admin and student) -->
                <div id="locationFields" class="row mb-4" style="display: none;">
                    <div class="col-12">
                        <h5 class="border-bottom pb-2 mb-3">{{ __('messages.location_information') }}</h5>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="country_id" class="form-label">{{ __('messages.country') }}</label>
                        <select class="form-select" id="country_id" name="country_id" onchange="loadCities(this.value)">
                            <option value="">{{ __('messages.select_country') }}</option>
                            @foreach($countries as $country)
                                <option value="{{ $country->id }}">
                                    {{ app()->getLocale() == 'ar' ? $country->name_ar : $country->name_en }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="city_id" class="form-label">{{ __('messages.city') }}</label>
                        <select class="form-select" id="city_id" name="city_id">
                            <option value="">{{ __('messages.select_city') }}</option>
                        </select>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="district" class="form-label">{{ __('messages.district_area') }}</label>
                        <input type="text" class="form-control" id="district" name="district">
                    </div>

                    <div class="col-md-12 mb-3">
                        <label for="location" class="form-label">{{ __('messages.exact_location') }}</label>
                        <textarea class="form-control" id="location" name="location" rows="2"></textarea>
                    </div>

                    <div class="col-md-12 mb-3">
                        <label for="description" class="form-label">{{ __('messages.full_description') }}</label>
                        <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                    </div>
                </div>

                <!-- Teacher Specific Fields -->
                <div id="teacherFields" class="row mb-4" style="display: none;">
                    <div class="col-12">
                        <h5 class="border-bottom pb-2 mb-3">{{ __('messages.teacher_details') }}</h5>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="degree" class="form-label">{{ __('messages.academic_degree') }}</label>
                        <select class="form-select" id="degree" name="degree">
                            <option value="">{{ __('messages.select_country') }}</option>
                            <option value="diploma">{{ __('messages.diploma') }}</option>
                            <option value="bachelor">{{ __('messages.bachelor') }}</option>
                            <option value="master">{{ __('messages.master') }}</option>
                            <option value="phd">{{ __('messages.doctorate') }}</option>
                        </select>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="gender" class="form-label">{{ __('messages.gender') }}</label>
                        <select class="form-select" id="gender" name="gender">
                            <option value="">{{ __('messages.select_country') }}</option>
                            <option value="male">{{ __('messages.male') }}</option>
                            <option value="female">{{ __('messages.female') }}</option>
                        </select>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="experience" class="form-label">{{ __('messages.work_experience') }}</label>
                        <input type="text" class="form-control" id="experience" name="experience">
                    </div>

                    <div class="col-md-12 mb-3">
                        <label for="subjects" class="form-label">{{ __('messages.subjects_taught') }}</label>
                        <select class="form-select" id="subjects" name="subjects[]" multiple size="5">
                            @foreach($subjects as $subject)
                                <option value="{{ $subject->id }}">
                                    {{ app()->getLocale() == 'ar' ? $subject->name_ar : $subject->name_en }}
                                </option>
                            @endforeach
                        </select>
                        <small class="text-muted">{{ __('messages.hold_ctrl_select_multiple') }}</small>
                    </div>
                </div>

                <!-- Educational Center Specific Fields -->
                <div id="centerFields" class="row mb-4" style="display: none;">
                    <div class="col-12">
                        <h5 class="border-bottom pb-2 mb-3">{{ __('messages.center_details') }}</h5>
                    </div>

                    <div class="col-md-12 mb-3">
                        <label for="center_subjects" class="form-label">{{ __('messages.subjects_taught') }}</label>
                        <select class="form-select" id="center_subjects" name="subjects[]" multiple size="5">
                            @foreach($subjects as $subject)
                                <option value="{{ $subject->id }}">
                                    {{ app()->getLocale() == 'ar' ? $subject->name_ar : $subject->name_en }}
                                </option>
                            @endforeach
                        </select>
                        <small class="text-muted">{{ __('messages.hold_ctrl_select_multiple') }}</small>
                    </div>
                </div>

                <!-- School Specific Fields -->
                <div id="schoolFields" class="row mb-4" style="display: none;">
                    <div class="col-12">
                        <h5 class="border-bottom pb-2 mb-3">{{ __('messages.school_details') }}</h5>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="grades" class="form-label">{{ __('messages.grades_taught') }}</label>
                        <select class="form-select" id="grades" name="grades[]" multiple size="5">
                            @foreach($grades->where('type', 'school') as $grade)
                                <option value="{{ $grade->id }}">
                                    {{ app()->getLocale() == 'ar' ? $grade->name_ar : $grade->name_en }}
                                </option>
                            @endforeach
                        </select>
                        <small class="text-muted">{{ __('messages.hold_ctrl_select_multiple') }}</small>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="educational_stages" class="form-label">{{ __('messages.educational_stages') }}</label>
                        <select class="form-select" id="educational_stages" name="educational_stages[]" multiple size="3">
                            @foreach($educationalStages as $stage)
                                <option value="{{ $stage->id }}">
                                    {{ app()->getLocale() == 'ar' ? $stage->name_ar : $stage->name_en }}
                                </option>
                            @endforeach
                        </select>
                        <small class="text-muted">{{ __('messages.hold_ctrl_select_multiple') }}</small>
                    </div>

                    <div class="col-md-12 mb-3">
                        <label for="student_types" class="form-label">{{ __('messages.student_types') }}</label>
                        <select class="form-select" id="student_types" name="student_types[]" multiple size="3">
                            @foreach($studentTypes as $type)
                                <option value="{{ $type->id }}">
                                    {{ app()->getLocale() == 'ar' ? $type->name_ar : $type->name_en }}
                                </option>
                            @endforeach
                        </select>
                        <small class="text-muted">{{ __('messages.hold_ctrl_select_multiple') }}</small>
                    </div>
                </div>

                <!-- Nursery Specific Fields -->
                <div id="nurseryFields" class="row mb-4" style="display: none;">
                    <div class="col-12">
                        <h5 class="border-bottom pb-2 mb-3">{{ __('messages.nursery_details') }}</h5>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="min_age_months" class="form-label">{{ __('messages.minimum_age_months') }}</label>
                        <input type="number" class="form-control" id="min_age_months" name="min_age_months" min="1" max="60"
                            value="1">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="max_age_months" class="form-label">{{ __('messages.maximum_age_months') }}</label>
                        <input type="number" class="form-control" id="max_age_months" name="max_age_months" min="1" max="60"
                            value="60">
                    </div>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left me-2"></i>{{ __('messages.back') }}
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save me-2"></i>{{ __('messages.create_user') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        function toggleRoleFields() {
            const role = document.getElementById('role').value;

            // Hide all role-specific fields
            document.getElementById('locationFields').style.display = 'none';
            document.getElementById('teacherFields').style.display = 'none';
            document.getElementById('centerFields').style.display = 'none';
            document.getElementById('schoolFields').style.display = 'none';
            document.getElementById('nurseryFields').style.display = 'none';

            // Show relevant fields based on role
            if (role === 'teacher') {
                document.getElementById('locationFields').style.display = 'block';
                document.getElementById('teacherFields').style.display = 'block';
            } else if (role === 'educational_center') {
                document.getElementById('locationFields').style.display = 'block';
                document.getElementById('centerFields').style.display = 'block';
            } else if (role === 'school') {
                document.getElementById('locationFields').style.display = 'block';
                document.getElementById('schoolFields').style.display = 'block';
            } else if (role === 'kindergarten') {
                document.getElementById('locationFields').style.display = 'block';
            } else if (role === 'nursery') {
                document.getElementById('locationFields').style.display = 'block';
                document.getElementById('nurseryFields').style.display = 'block';
            }
        }

        function loadCities(countryId) {
            const citySelect = document.getElementById('city_id');
            citySelect.innerHTML = '<option value="">{{ __("messages.select_city") }}</option>';

            if (!countryId) return;

            fetch(`/register/cities/${countryId}`)
                .then(response => response.json())
                .then(cities => {
                    cities.forEach(city => {
                        const option = document.createElement('option');
                        option.value = city.id;
                        option.textContent = '{{ app()->getLocale() }}' === 'ar' ? city.name_ar : city.name_en;
                        citySelect.appendChild(option);
                    });
                });
        }

        // Trigger on page load if role is already selected
        document.addEventListener('DOMContentLoaded', function () {
            toggleRoleFields();
        });
    </script>
@endsection