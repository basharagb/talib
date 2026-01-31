@extends('layouts.dashboard')

@section('title', __('messages.analytics_dashboard') . ' - ' . config('app.name', 'طالب'))

@section('page-title', __('messages.analytics_dashboard'))

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('messages.dashboard') }}</a></li>
    <li class="breadcrumb-item active">{{ __('messages.analytics') }}</li>
@endsection

@section('content')
    <!-- Filters Section -->
    <div class="card mb-4">
        <div class="card-header">
            <h3 class="card-title"><i class="bi bi-funnel me-2"></i>{{ __('messages.filters') }}</h3>
        </div>
        <div class="card-body">
            <form method="GET" action="{{ route('admin.analytics.index') }}" class="row g-3">
                <div class="col-md-3">
                    <label class="form-label">{{ __('messages.country') }}</label>
                    <select name="country" class="form-select">
                        <option value="">{{ __('messages.all_countries') }}</option>
                        @foreach($countries as $country)
                            <option value="{{ $country->code }}" {{ $countryFilter == $country->code ? 'selected' : '' }}>
                                {{ app()->getLocale() == 'ar' ? $country->name_ar : $country->name_en }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <label class="form-label">{{ __('messages.gender') }}</label>
                    <select name="gender" class="form-select">
                        <option value="">{{ __('messages.all') }}</option>
                        <option value="male" {{ $genderFilter == 'male' ? 'selected' : '' }}>{{ __('messages.male') }}</option>
                        <option value="female" {{ $genderFilter == 'female' ? 'selected' : '' }}>{{ __('messages.female') }}</option>
                        <option value="unknown" {{ $genderFilter == 'unknown' ? 'selected' : '' }}>{{ __('messages.unknown') }}</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <label class="form-label">{{ __('messages.date_from') }}</label>
                    <input type="date" name="date_from" class="form-control" value="{{ $dateFrom }}">
                </div>
                <div class="col-md-2">
                    <label class="form-label">{{ __('messages.date_to') }}</label>
                    <input type="date" name="date_to" class="form-control" value="{{ $dateTo }}">
                </div>
                <div class="col-md-3 d-flex align-items-end gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-search me-1"></i>{{ __('messages.filter') }}
                    </button>
                    <a href="{{ route('admin.analytics.index') }}" class="btn btn-secondary">
                        <i class="bi bi-x-circle me-1"></i>{{ __('messages.reset') }}
                    </a>
                    <a href="{{ route('admin.analytics.export') }}" class="btn btn-success">
                        <i class="bi bi-download me-1"></i>{{ __('messages.export') }}
                    </a>
                </div>
            </form>
        </div>
    </div>

    <!-- Statistics Cards Row 1 -->
    <div class="row">
        <div class="col-lg-3 col-6">
            <div class="small-box text-bg-primary">
                <div class="inner">
                    <h3>{{ number_format($totalVisitors) }}</h3>
                    <p>{{ __('messages.total_visitors') }}</p>
                </div>
                <svg class="small-box-icon" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    <path d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                </svg>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box text-bg-success">
                <div class="inner">
                    <h3>{{ number_format($uniqueVisitors) }}</h3>
                    <p>{{ __('messages.unique_visitors') }}</p>
                </div>
                <svg class="small-box-icon" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                </svg>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box text-bg-warning">
                <div class="inner">
                    <h3>{{ number_format($visitorsToday) }}</h3>
                    <p>{{ __('messages.visitors_today') }}</p>
                </div>
                <svg class="small-box-icon" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box text-bg-info">
                <div class="inner">
                    <h3>{{ number_format($uniqueVisitorsToday) }}</h3>
                    <p>{{ __('messages.unique_today') }}</p>
                </div>
                <svg class="small-box-icon" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
        </div>
    </div>

    <!-- Statistics Cards Row 2 -->
    <div class="row">
        <div class="col-lg-3 col-6">
            <div class="small-box text-bg-secondary">
                <div class="inner">
                    <h3>{{ number_format($totalRegisteredUsers) }}</h3>
                    <p>{{ __('messages.registered_users') }}</p>
                </div>
                <svg class="small-box-icon" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197"></path>
                </svg>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box text-bg-danger">
                <div class="inner">
                    <h3>{{ number_format($activeSubscribedUsers) }}</h3>
                    <p>{{ __('messages.subscribed_users') }}</p>
                </div>
                <svg class="small-box-icon" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M5 13l4 4L19 7"></path>
                </svg>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white;">
                <div class="inner">
                    <h3>{{ number_format($maleVisitors) }}</h3>
                    <p>{{ __('messages.male_visitors') }}</p>
                </div>
                <svg class="small-box-icon" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                </svg>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); color: white;">
                <div class="inner">
                    <h3>{{ number_format($femaleVisitors) }}</h3>
                    <p>{{ __('messages.female_visitors') }}</p>
                </div>
                <svg class="small-box-icon" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                </svg>
            </div>
        </div>
    </div>

    <!-- Charts Row -->
    <div class="row mt-4">
        <!-- Daily Visitors Chart -->
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"><i class="bi bi-graph-up me-2"></i>{{ __('messages.daily_visitors_chart') }}</h3>
                </div>
                <div class="card-body">
                    <canvas id="dailyVisitorsChart" height="100"></canvas>
                </div>
            </div>
        </div>

        <!-- Gender Distribution Chart -->
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"><i class="bi bi-pie-chart me-2"></i>{{ __('messages.gender_distribution') }}</h3>
                </div>
                <div class="card-body">
                    <canvas id="genderChart" height="200"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- More Charts Row -->
    <div class="row mt-4">
        <!-- Top Countries Chart -->
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"><i class="bi bi-globe me-2"></i>{{ __('messages.top_countries') }}</h3>
                </div>
                <div class="card-body">
                    <canvas id="countriesChart" height="200"></canvas>
                </div>
            </div>
        </div>

        <!-- Top Regions Chart -->
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"><i class="bi bi-geo-alt me-2"></i>{{ __('messages.most_visited_regions') }}</h3>
                </div>
                <div class="card-body">
                    <canvas id="regionsChart" height="200"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Device & Browser Row -->
    <div class="row mt-4">
        <!-- Device Stats -->
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"><i class="bi bi-phone me-2"></i>{{ __('messages.device_statistics') }}</h3>
                </div>
                <div class="card-body">
                    <canvas id="deviceChart" height="200"></canvas>
                </div>
            </div>
        </div>

        <!-- Browser Stats -->
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"><i class="bi bi-browser-chrome me-2"></i>{{ __('messages.browser_statistics') }}</h3>
                </div>
                <div class="card-body">
                    <canvas id="browserChart" height="200"></canvas>
                </div>
            </div>
        </div>

        <!-- Users by Role -->
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"><i class="bi bi-people me-2"></i>{{ __('messages.users_by_role') }}</h3>
                </div>
                <div class="card-body">
                    <canvas id="rolesChart" height="200"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Visitors Table -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"><i class="bi bi-table me-2"></i>{{ __('messages.recent_visitors') }}</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{ __('messages.ip_address') }}</th>
                                    <th>{{ __('messages.user') }}</th>
                                    <th>{{ __('messages.gender') }}</th>
                                    <th>{{ __('messages.country') }}</th>
                                    <th>{{ __('messages.city') }}</th>
                                    <th>{{ __('messages.page') }}</th>
                                    <th>{{ __('messages.device') }}</th>
                                    <th>{{ __('messages.browser') }}</th>
                                    <th>{{ __('messages.date') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recentVisitors as $visitor)
                                    <tr>
                                        <td>{{ $visitor->id }}</td>
                                        <td><code>{{ $visitor->ip_address }}</code></td>
                                        <td>
                                            @if($visitor->user)
                                                <span class="badge bg-primary">{{ $visitor->user->name }}</span>
                                            @else
                                                <span class="badge bg-secondary">{{ __('messages.guest') }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($visitor->gender == 'male')
                                                <span class="badge bg-info">{{ __('messages.male') }}</span>
                                            @elseif($visitor->gender == 'female')
                                                <span class="badge bg-pink">{{ __('messages.female') }}</span>
                                            @else
                                                <span class="badge bg-secondary">{{ __('messages.unknown') }}</span>
                                            @endif
                                        </td>
                                        <td>{{ $visitor->country_name ?? '-' }}</td>
                                        <td>{{ $visitor->city ?? '-' }}</td>
                                        <td><small>{{ Str::limit($visitor->page_visited, 30) }}</small></td>
                                        <td>
                                            @if($visitor->device_type == 'mobile')
                                                <i class="bi bi-phone text-primary"></i>
                                            @elseif($visitor->device_type == 'tablet')
                                                <i class="bi bi-tablet text-success"></i>
                                            @else
                                                <i class="bi bi-laptop text-info"></i>
                                            @endif
                                            {{ $visitor->device_type }}
                                        </td>
                                        <td>{{ $visitor->browser ?? '-' }}</td>
                                        <td><small>{{ $visitor->created_at->format('Y-m-d H:i') }}</small></td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="10" class="text-center text-muted py-4">
                                            {{ __('messages.no_visitors_yet') }}
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Daily Visitors Chart
    const dailyCtx = document.getElementById('dailyVisitorsChart').getContext('2d');
    new Chart(dailyCtx, {
        type: 'line',
        data: {
            labels: {!! json_encode($dailyVisitors->pluck('date')->toArray()) !!},
            datasets: [{
                label: '{{ __("messages.total_visits") }}',
                data: {!! json_encode($dailyVisitors->pluck('visits')->toArray()) !!},
                borderColor: 'rgb(75, 192, 192)',
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                tension: 0.3,
                fill: true
            }, {
                label: '{{ __("messages.unique_visitors") }}',
                data: {!! json_encode($dailyVisitors->pluck('unique_visitors')->toArray()) !!},
                borderColor: 'rgb(54, 162, 235)',
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                tension: 0.3,
                fill: true
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { position: 'top' }
            },
            scales: {
                y: { beginAtZero: true }
            }
        }
    });

    // Gender Distribution Chart
    const genderCtx = document.getElementById('genderChart').getContext('2d');
    new Chart(genderCtx, {
        type: 'doughnut',
        data: {
            labels: ['{{ __("messages.male") }}', '{{ __("messages.female") }}', '{{ __("messages.unknown") }}'],
            datasets: [{
                data: [{{ $maleVisitors }}, {{ $femaleVisitors }}, {{ $unknownGender }}],
                backgroundColor: ['#667eea', '#f093fb', '#6c757d']
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { position: 'bottom' }
            }
        }
    });

    // Countries Chart
    const countriesCtx = document.getElementById('countriesChart').getContext('2d');
    new Chart(countriesCtx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($countryStats->pluck('country_name')->toArray()) !!},
            datasets: [{
                label: '{{ __("messages.visits") }}',
                data: {!! json_encode($countryStats->pluck('visits')->toArray()) !!},
                backgroundColor: 'rgba(54, 162, 235, 0.8)'
            }]
        },
        options: {
            responsive: true,
            indexAxis: 'y',
            plugins: {
                legend: { display: false }
            }
        }
    });

    // Regions Chart
    const regionsCtx = document.getElementById('regionsChart').getContext('2d');
    new Chart(regionsCtx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($regionStats->pluck('region')->toArray()) !!},
            datasets: [{
                label: '{{ __("messages.visits") }}',
                data: {!! json_encode($regionStats->pluck('visits')->toArray()) !!},
                backgroundColor: 'rgba(255, 159, 64, 0.8)'
            }]
        },
        options: {
            responsive: true,
            indexAxis: 'y',
            plugins: {
                legend: { display: false }
            }
        }
    });

    // Device Chart
    const deviceCtx = document.getElementById('deviceChart').getContext('2d');
    new Chart(deviceCtx, {
        type: 'pie',
        data: {
            labels: {!! json_encode(array_keys($deviceStats)) !!},
            datasets: [{
                data: {!! json_encode(array_values($deviceStats)) !!},
                backgroundColor: ['#36a2eb', '#ff6384', '#ffce56']
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { position: 'bottom' }
            }
        }
    });

    // Browser Chart
    const browserCtx = document.getElementById('browserChart').getContext('2d');
    new Chart(browserCtx, {
        type: 'pie',
        data: {
            labels: {!! json_encode(array_keys($browserStats)) !!},
            datasets: [{
                data: {!! json_encode(array_values($browserStats)) !!},
                backgroundColor: ['#4bc0c0', '#9966ff', '#ff9f40', '#ff6384', '#36a2eb']
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { position: 'bottom' }
            }
        }
    });

    // Users by Role Chart
    const rolesCtx = document.getElementById('rolesChart').getContext('2d');
    new Chart(rolesCtx, {
        type: 'doughnut',
        data: {
            labels: {!! json_encode(array_keys($usersByRole)) !!},
            datasets: [{
                data: {!! json_encode(array_values($usersByRole)) !!},
                backgroundColor: ['#0d6efd', '#198754', '#ffc107', '#dc3545', '#6f42c1', '#20c997', '#fd7e14']
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { position: 'bottom' }
            }
        }
    });
});
</script>
@endpush

<style>
.bg-pink {
    background-color: #f093fb !important;
}
</style>
