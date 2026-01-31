@extends('layouts.dashboard')

@section('title', __('messages.user_management') . ' - ' . config('app.name', 'طالب'))

@section('page-title', __('messages.user_management'))

@section('breadcrumb')
    <li class="breadcrumb-item active">{{ __('messages.user_management') }}</li>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">
            <h3 class="card-title">{{ __('messages.all_users') }}</h3>
            <a href="{{ route('admin.users.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-circle me-2"></i>{{ __('messages.add_new_user') }}
            </a>
        </div>
    </div>
    
    <div class="card-body">
        <!-- Filters -->
        <form method="GET" action="{{ route('admin.users.index') }}" class="mb-4">
            <div class="row g-3">
                <div class="col-md-3">
                    <input type="text" name="search" class="form-control" placeholder="{{ __('messages.search_by_name_email') }}" value="{{ request('search') }}">
                </div>
                <div class="col-md-3">
                    <select name="role" class="form-select">
                        <option value="">{{ __('messages.all_roles') }}</option>
                        <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>{{ __('messages.admin') }}</option>
                        <option value="teacher" {{ request('role') == 'teacher' ? 'selected' : '' }}>{{ __('messages.teacher') }}</option>
                        <option value="educational_center" {{ request('role') == 'educational_center' ? 'selected' : '' }}>{{ __('messages.educational_center') }}</option>
                        <option value="school" {{ request('role') == 'school' ? 'selected' : '' }}>{{ __('messages.school') }}</option>
                        <option value="kindergarten" {{ request('role') == 'kindergarten' ? 'selected' : '' }}>{{ __('messages.kindergarten') }}</option>
                        <option value="nursery" {{ request('role') == 'nursery' ? 'selected' : '' }}>{{ __('messages.nursery') }}</option>
                        <option value="student" {{ request('role') == 'student' ? 'selected' : '' }}>{{ __('messages.student') }}</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <select name="status" class="form-select">
                        <option value="">{{ __('messages.all_statuses') }}</option>
                        <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>{{ __('messages.active') }}</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>{{ __('messages.pending') }}</option>
                        <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>{{ __('messages.inactive') }}</option>
                        <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>{{ __('messages.rejected') }}</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <button type="submit" class="btn btn-secondary w-100">
                        <i class="bi bi-funnel me-2"></i>{{ __('messages.filter') }}
                    </button>
                </div>
            </div>
        </form>

        <!-- Users Table -->
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>{{ __('messages.id') }}</th>
                        <th>{{ __('messages.name') }}</th>
                        <th>{{ __('messages.email') }}</th>
                        <th>{{ __('messages.role') }}</th>
                        <th>{{ __('messages.status') }}</th>
                        <th>{{ __('messages.created_at') }}</th>
                        <th>{{ __('messages.actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            <span class="badge bg-info">{{ __('messages.' . $user->role) }}</span>
                        </td>
                        <td>
                            @if($user->status == 'active')
                                <span class="badge bg-success">{{ __('messages.active') }}</span>
                            @elseif($user->status == 'pending')
                                <span class="badge bg-warning">{{ __('messages.pending') }}</span>
                            @elseif($user->status == 'inactive')
                                <span class="badge bg-secondary">{{ __('messages.inactive') }}</span>
                            @else
                                <span class="badge bg-danger">{{ __('messages.rejected') }}</span>
                            @endif
                        </td>
                        <td>{{ $user->created_at->format('Y-m-d') }}</td>
                        <td>
                            <div class="btn-group" role="group">
                                <a href="{{ route('admin.users.show', $user) }}" class="btn btn-sm btn-info" title="{{ __('messages.view') }}">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-sm btn-primary" title="{{ __('messages.edit') }}">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                @if($user->id !== auth()->id())
                                <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="d-inline" onsubmit="return confirm('{{ __('messages.confirm_delete') }}')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" title="{{ __('messages.delete') }}">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center">{{ __('messages.no_users_found') }}</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-center">
            {{ $users->links() }}
        </div>
    </div>
</div>
@endsection
