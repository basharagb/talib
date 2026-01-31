<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules;

class UserManagementController extends Controller
{
    /**
     * Display a listing of all users
     */
    public function index(Request $request)
    {
        $query = User::query();

        // Filter by role
        if ($request->has('role') && $request->role != '') {
            $query->where('role', $request->role);
        }

        // Filter by status
        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        // Search by name or email
        if ($request->has('search') && $request->search != '') {
            $query->where(function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('email', 'like', '%' . $request->search . '%');
            });
        }

        $users = $query->orderBy('created_at', 'desc')->paginate(20);

        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new user
     */
    public function create()
    {
        $countries = \App\Models\Country::all();
        $subjects = \App\Models\Subject::all();
        $grades = \App\Models\Grade::all();
        $educationalStages = \App\Models\EducationalStage::all();
        $studentTypes = \App\Models\StudentType::all();
        
        return view('admin.users.create', compact('countries', 'subjects', 'grades', 'educationalStages', 'studentTypes'));
    }

    /**
     * Store a newly created user
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => ['required', 'in:admin,teacher,educational_center,school,kindergarten,nursery,student'],
            'phone' => ['nullable', 'string', 'max:20'],
            'status' => ['required', 'in:active,pending,inactive,rejected'],
        ]);

        DB::beginTransaction();
        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => $request->role,
                'phone' => $request->phone,
                'status' => $request->status,
                'email_verified_at' => $request->status === 'active' ? now() : null,
            ]);

            // Create related profile based on role
            switch ($request->role) {
                case 'teacher':
                    $this->createTeacherProfile($user, $request);
                    break;
                case 'educational_center':
                    $this->createEducationalCenterProfile($user, $request);
                    break;
                case 'school':
                    $this->createSchoolProfile($user, $request);
                    break;
                case 'kindergarten':
                    $this->createKindergartenProfile($user, $request);
                    break;
                case 'nursery':
                    $this->createNurseryProfile($user, $request);
                    break;
            }

            DB::commit();
            return redirect()->route('admin.users.index')
                ->with('success', __('messages.user_created_successfully'));
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => $e->getMessage()])->withInput();
        }
    }

    private function createTeacherProfile($user, $request)
    {
        if (!$request->filled('country_id')) return;
        
        $data = [
            'user_id' => $user->id,
            'country_id' => $request->country_id,
            'city_id' => $request->city_id,
            'district' => $request->district,
            'location' => $request->location,
            'degree' => $request->degree,
            'description' => $request->description,
            'gender' => $request->gender,
            'experience' => $request->experience,
            'subscription_fee' => 10,
        ];

        // Handle profile image upload
        if ($request->hasFile('profile_image')) {
            $data['profile_image'] = $request->file('profile_image')->store('teachers/profiles', 'public');
        }

        // Handle CV file upload
        if ($request->hasFile('cv_file')) {
            $data['cv_file'] = $request->file('cv_file')->store('teachers/cvs', 'public');
        }

        // Handle certificates upload
        if ($request->hasFile('certificates')) {
            $certificatePaths = [];
            foreach ($request->file('certificates') as $certificate) {
                $certificatePaths[] = $certificate->store('teachers/certificates', 'public');
            }
            $data['certificates'] = $certificatePaths;
        }

        // Handle social links
        $socialLinks = [];
        if ($request->facebook) $socialLinks['facebook'] = $request->facebook;
        if ($request->twitter) $socialLinks['twitter'] = $request->twitter;
        if ($request->instagram) $socialLinks['instagram'] = $request->instagram;
        if ($request->linkedin) $socialLinks['linkedin'] = $request->linkedin;
        if ($request->whatsapp) $socialLinks['whatsapp'] = $request->whatsapp;
        if (!empty($socialLinks)) {
            $data['social_links'] = $socialLinks;
        }

        $teacher = \App\Models\Teacher::create($data);

        if ($request->has('subjects')) {
            $teacher->subjects()->attach($request->subjects);
        }
    }

    private function createEducationalCenterProfile($user, $request)
    {
        if (!$request->filled('country_id')) return;
        
        $data = [
            'user_id' => $user->id,
            'country_id' => $request->country_id,
            'city_id' => $request->city_id,
            'district' => $request->district,
            'location' => $request->location,
            'description' => $request->description,
            'facebook' => $request->facebook,
            'twitter' => $request->twitter,
            'instagram' => $request->instagram,
            'whatsapp' => $request->whatsapp,
        ];

        if ($request->hasFile('logo')) {
            $data['logo'] = $request->file('logo')->store('centers/logos', 'public');
        }

        $center = \App\Models\EducationalCenter::create($data);

        if ($request->has('subjects')) {
            $center->subjects()->attach($request->subjects);
        }
    }

    private function createSchoolProfile($user, $request)
    {
        if (!$request->filled('country_id')) return;
        
        $data = [
            'user_id' => $user->id,
            'country_id' => $request->country_id,
            'city_id' => $request->city_id,
            'district' => $request->district,
            'location' => $request->location,
            'description' => $request->description,
            'facebook' => $request->facebook,
            'twitter' => $request->twitter,
            'instagram' => $request->instagram,
            'whatsapp' => $request->whatsapp,
        ];

        if ($request->hasFile('logo')) {
            $data['logo'] = $request->file('logo')->store('schools/logos', 'public');
        }

        $school = \App\Models\School::create($data);

        if ($request->has('grades')) {
            $school->grades()->attach($request->grades);
        }
        if ($request->has('educational_stages')) {
            $school->educationalStages()->attach($request->educational_stages);
        }
        if ($request->has('student_types')) {
            $school->studentTypes()->attach($request->student_types);
        }
    }

    private function createKindergartenProfile($user, $request)
    {
        if (!$request->filled('country_id')) return;
        
        $data = [
            'user_id' => $user->id,
            'country_id' => $request->country_id,
            'city_id' => $request->city_id,
            'name' => $request->name,
            'description' => $request->description,
            'phone' => $request->phone,
            'email' => $request->email,
            'address' => $request->location,
            'is_active' => $request->status === 'active',
            'facebook' => $request->facebook,
            'twitter' => $request->twitter,
            'instagram' => $request->instagram,
            'whatsapp' => $request->whatsapp,
        ];

        if ($request->hasFile('logo')) {
            $data['logo'] = $request->file('logo')->store('kindergartens/logos', 'public');
        }

        \App\Models\Kindergarten::create($data);
    }

    private function createNurseryProfile($user, $request)
    {
        if (!$request->filled('country_id')) return;
        
        $data = [
            'user_id' => $user->id,
            'country_id' => $request->country_id,
            'city_id' => $request->city_id,
            'name' => $request->name,
            'description' => $request->description,
            'phone' => $request->phone,
            'email' => $request->email,
            'address' => $request->location,
            'is_active' => $request->status === 'active',
            'min_age_months' => $request->min_age_months ?? 1,
            'max_age_months' => $request->max_age_months ?? 60,
            'facebook' => $request->facebook,
            'twitter' => $request->twitter,
            'instagram' => $request->instagram,
            'whatsapp' => $request->whatsapp,
        ];

        if ($request->hasFile('logo')) {
            $data['logo'] = $request->file('logo')->store('nurseries/logos', 'public');
        }

        \App\Models\Nursery::create($data);
    }

    /**
     * Display the specified user
     */
    public function show(User $user)
    {
        return view('admin.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified user
     */
    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified user
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'role' => ['required', 'in:admin,teacher,educational_center,school,kindergarten,nursery,student'],
            'phone' => ['nullable', 'string', 'max:20'],
            'status' => ['required', 'in:active,pending,inactive,rejected'],
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'phone' => $request->phone,
            'status' => $request->status,
        ]);

        // If password is provided, update it
        if ($request->filled('password')) {
            $request->validate([
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
            ]);
            
            $user->update([
                'password' => Hash::make($request->password),
            ]);
        }

        return redirect()->route('admin.users.index')
            ->with('success', __('messages.user_updated_successfully'));
    }

    /**
     * Remove the specified user
     */
    public function destroy(User $user)
    {
        // Prevent deleting yourself
        if ($user->id === auth()->id()) {
            return redirect()->back()
                ->with('error', __('messages.cannot_delete_yourself'));
        }

        $user->delete();

        return redirect()->route('admin.users.index')
            ->with('success', __('messages.user_deleted_successfully'));
    }

    /**
     * Bulk update user status
     */
    public function bulkUpdateStatus(Request $request)
    {
        $request->validate([
            'user_ids' => ['required', 'array'],
            'user_ids.*' => ['exists:users,id'],
            'status' => ['required', 'in:active,pending,inactive,rejected'],
        ]);

        User::whereIn('id', $request->user_ids)
            ->update(['status' => $request->status]);

        return redirect()->back()
            ->with('success', __('messages.users_updated_successfully'));
    }
}
