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
        <form method="POST" action="{{ route('admin.users.store') }}">
            @csrf
            
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="name" class="form-label">{{ __('messages.name') }} <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="col-md-6 mb-3">
                    <label for="email" class="form-label">{{ __('messages.email') }} <span class="text-danger">*</span></label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="password" class="form-label">{{ __('messages.password') }} <span class="text-danger">*</span></label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required>
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="col-md-6 mb-3">
                    <label for="password_confirmation" class="form-label">{{ __('messages.confirm_password') }} <span class="text-danger">*</span></label>
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label for="role" class="form-label">{{ __('messages.role') }} <span class="text-danger">*</span></label>
                    <select class="form-select @error('role') is-invalid @enderror" id="role" name="role" required>
                        <option value="">{{ __('messages.select_role') }}</option>
                        <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>{{ __('messages.admin') }}</option>
                        <option value="teacher" {{ old('role') == 'teacher' ? 'selected' : '' }}>{{ __('messages.teacher') }}</option>
                        <option value="educational_center" {{ old('role') == 'educational_center' ? 'selected' : '' }}>{{ __('messages.educational_center') }}</option>
                        <option value="school" {{ old('role') == 'school' ? 'selected' : '' }}>{{ __('messages.school') }}</option>
                        <option value="kindergarten" {{ old('role') == 'kindergarten' ? 'selected' : '' }}>{{ __('messages.kindergarten') }}</option>
                        <option value="nursery" {{ old('role') == 'nursery' ? 'selected' : '' }}>{{ __('messages.nursery') }}</option>
                        <option value="student" {{ old('role') == 'student' ? 'selected' : '' }}>{{ __('messages.student') }}</option>
                    </select>
                    @error('role')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="col-md-4 mb-3">
                    <label for="status" class="form-label">{{ __('messages.status') }} <span class="text-danger">*</span></label>
                    <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
                        <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>{{ __('messages.active') }}</option>
                        <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>{{ __('messages.pending') }}</option>
                        <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>{{ __('messages.inactive') }}</option>
                    </select>
                    @error('status')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="col-md-4 mb-3">
                    <label for="phone" class="form-label">{{ __('messages.phone') }}</label>
                    <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone') }}">
                    @error('phone')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
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
