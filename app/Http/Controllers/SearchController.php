<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use App\Models\EducationalCenter;
use App\Models\School;
use App\Models\Kindergarten;
use App\Models\Nursery;
use App\Models\Country;
use App\Models\City;
use App\Models\Subject;
use App\Models\Grade;
use App\Models\EducationalStage;
use App\Models\StudentType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        // Load static data for filters (cached for performance)
        $countries = Cache::remember('countries', 3600, function () {
            return Country::all();
        });
        
        $subjects = Cache::remember('subjects', 3600, function () {
            return Subject::all();
        });
        
        $grades = Cache::remember('grades', 3600, function () {
            return Grade::all();
        });
        
        $educationalStages = Cache::remember('educational_stages', 3600, function () {
            return \App\Models\EducationalStage::all();
        });
        
        $studentTypes = Cache::remember('student_types', 3600, function () {
            return \App\Models\StudentType::all();
        });
        
        $results = [];
        $query = $request->get('q');
        $type = $request->get('type');
        $country_id = $request->get('country_id');
        $city_id = $request->get('city_id');
        $subject_id = $request->get('subject_id');
        $grade_id = $request->get('grade_id');
        $educational_stage_id = $request->get('educational_stage_id');
        $student_type_id = $request->get('student_type_id');

        if ($query || $type || $country_id || $city_id || $subject_id || $grade_id || $educational_stage_id || $student_type_id) {
            $results = $this->performSearch($query, $type, $country_id, $city_id, $subject_id, $grade_id, $educational_stage_id, $student_type_id);
            
            // Convert to paginated collection
            $perPage = 12;
            $currentPage = request()->get('page', 1);
            $results = $results->forPage($currentPage, $perPage);
            
            // Create paginator
            $paginator = new \Illuminate\Pagination\LengthAwarePaginator(
                $results,
                $this->getTotalResults($query, $type, $country_id, $city_id, $subject_id, $grade_id, $educational_stage_id, $student_type_id),
                $perPage,
                $currentPage,
                [
                    'path' => request()->url(),
                    'pageName' => 'page',
                ]
            );
            
            $paginator->appends(request()->query());
            $results = $paginator;
        }

        return view('search.index', compact(
            'results', 'query', 'type', 'countries', 'subjects', 'grades', 'educationalStages', 'studentTypes',
            'country_id', 'city_id', 'subject_id', 'grade_id', 'educational_stage_id', 'student_type_id'
        ));
    }

    private function performSearch($query, $type, $country_id, $city_id, $subject_id, $grade_id, $educational_stage_id = null, $student_type_id = null)
    {
        $results = collect();

        // Search Teachers
        if (!$type || $type === 'teacher') {
            $teachers = Teacher::with(['user', 'country', 'city', 'subjects'])
                ->whereHas('user', function ($q) use ($query) {
                    if ($query) {
                        $q->where('name', 'like', "%{$query}%");
                    }
                })
                ->when($country_id, function ($q) use ($country_id) {
                    $q->where('country_id', $country_id);
                })
                ->when($city_id, function ($q) use ($city_id) {
                    $q->where('city_id', $city_id);
                })
                ->when($subject_id, function ($q) use ($subject_id) {
                    $q->whereHas('subjects', function ($sq) use ($subject_id) {
                        $sq->where('subjects.id', $subject_id);
                    });
                })
                ->whereHas('user.subscription', function ($q) {
                    $q->where('status', 'active');
                })
                ->get()
                ->map(function ($teacher) {
                    return [
                        'type' => 'teacher',
                        'id' => $teacher->id,
                        'name' => $teacher->user->name,
                        'description' => $teacher->description,
                        'location' => $teacher->city->name_en . ', ' . $teacher->country->name_en,
                        'phone' => $teacher->user->phone,
                        'image' => $teacher->profile_image,
                        'subjects' => $teacher->subjects->pluck('name_en')->implode(', '),
                        'degree' => $teacher->degree,
                        'experience' => $teacher->experience,
                    ];
                });

            $results = $results->merge($teachers);
        }

        // Search Educational Centers
        if (!$type || $type === 'educational_center') {
            $centers = EducationalCenter::with(['user', 'country', 'city', 'subjects'])
                ->whereHas('user', function ($q) use ($query) {
                    if ($query) {
                        $q->where('name', 'like', "%{$query}%");
                    }
                })
                ->when($country_id, function ($q) use ($country_id) {
                    $q->where('country_id', $country_id);
                })
                ->when($city_id, function ($q) use ($city_id) {
                    $q->where('city_id', $city_id);
                })
                ->when($subject_id, function ($q) use ($subject_id) {
                    $q->whereHas('subjects', function ($sq) use ($subject_id) {
                        $sq->where('subjects.id', $subject_id);
                    });
                })
                ->whereHas('user.subscription', function ($q) {
                    $q->where('status', 'active');
                })
                ->get()
                ->map(function ($center) {
                    return [
                        'type' => 'educational_center',
                        'id' => $center->id,
                        'name' => $center->user->name,
                        'description' => $center->description,
                        'location' => $center->city->name_en . ', ' . $center->country->name_en,
                        'phone' => $center->user->phone,
                        'image' => $center->logo,
                        'subjects' => $center->subjects->pluck('name_en')->implode(', '),
                    ];
                });

            $results = $results->merge($centers);
        }

        // Search Schools
        if (!$type || $type === 'school') {
            $schools = School::with(['user', 'country', 'city', 'grades', 'educationalStages', 'studentTypes'])
                ->whereHas('user', function ($q) use ($query) {
                    if ($query) {
                        $q->where('name', 'like', "%{$query}%");
                    }
                })
                ->when($country_id, function ($q) use ($country_id) {
                    $q->where('country_id', $country_id);
                })
                ->when($city_id, function ($q) use ($city_id) {
                    $q->where('city_id', $city_id);
                })
                ->when($grade_id, function ($q) use ($grade_id) {
                    $q->whereHas('grades', function ($gq) use ($grade_id) {
                        $gq->where('grades.id', $grade_id);
                    });
                })
                ->when($educational_stage_id, function ($q) use ($educational_stage_id) {
                    $q->whereHas('educationalStages', function ($esq) use ($educational_stage_id) {
                        $esq->where('educational_stages.id', $educational_stage_id);
                    });
                })
                ->when($student_type_id, function ($q) use ($student_type_id) {
                    $q->whereHas('studentTypes', function ($stq) use ($student_type_id) {
                        $stq->where('student_types.id', $student_type_id);
                    });
                })
                ->whereHas('user.subscription', function ($q) {
                    $q->where('status', 'active');
                })
                ->get()
                ->map(function ($school) {
                    return [
                        'type' => 'school',
                        'id' => $school->id,
                        'name' => $school->user->name,
                        'description' => $school->description,
                        'location' => $school->city->name_en . ', ' . $school->country->name_en,
                        'phone' => $school->user->phone,
                        'image' => $school->logo,
                        'grades' => $school->grades->pluck('name_en')->implode(', '),
                        'educational_stages' => $school->educationalStages->pluck('name_ar')->implode(', '),
                        'student_types' => $school->studentTypes->pluck('name_ar')->implode(', '),
                    ];
                });

            $results = $results->merge($schools);
        }

        // Search Kindergartens
        if (!$type || $type === 'kindergarten') {
            $kindergartens = Kindergarten::with(['user', 'country', 'city', 'grades'])
                ->whereHas('user', function ($q) use ($query) {
                    if ($query) {
                        $q->where('name', 'like', "%{$query}%");
                    }
                })
                ->when($country_id, function ($q) use ($country_id) {
                    $q->where('country_id', $country_id);
                })
                ->when($city_id, function ($q) use ($city_id) {
                    $q->where('city_id', $city_id);
                })
                ->when($grade_id, function ($q) use ($grade_id) {
                    $q->whereHas('grades', function ($gq) use ($grade_id) {
                        $gq->where('grades.id', $grade_id);
                    });
                })
                ->whereHas('user.subscription', function ($q) {
                    $q->where('status', 'active');
                })
                ->get()
                ->map(function ($kindergarten) {
                    return [
                        'type' => 'kindergarten',
                        'id' => $kindergarten->id,
                        'name' => $kindergarten->user->name,
                        'description' => $kindergarten->description,
                        'location' => $kindergarten->city->name_en . ', ' . $kindergarten->country->name_en,
                        'phone' => $kindergarten->user->phone,
                        'image' => $kindergarten->logo,
                        'grades' => $kindergarten->grades->pluck('name_en')->implode(', '),
                    ];
                });

            $results = $results->merge($kindergartens);
        }

        // Search Nurseries
        if (!$type || $type === 'nursery') {
            $nurseries = Nursery::with(['user', 'country', 'city'])
                ->whereHas('user', function ($q) use ($query) {
                    if ($query) {
                        $q->where('name', 'like', "%{$query}%");
                    }
                })
                ->when($country_id, function ($q) use ($country_id) {
                    $q->where('country_id', $country_id);
                })
                ->when($city_id, function ($q) use ($city_id) {
                    $q->where('city_id', $city_id);
                })
                ->whereHas('user.subscription', function ($q) {
                    $q->where('status', 'active');
                })
                ->get()
                ->map(function ($nursery) {
                    return [
                        'type' => 'nursery',
                        'id' => $nursery->id,
                        'name' => $nursery->user->name,
                        'description' => $nursery->description,
                        'location' => $nursery->city->name_en . ', ' . $nursery->country->name_en,
                        'phone' => $nursery->user->phone,
                        'image' => $nursery->logo,
                        'ages' => $nursery->ages_accepted ? implode(', ', json_decode($nursery->ages_accepted)) : '',
                    ];
                });

            $results = $results->merge($nurseries);
        }

        return $results;
    }

    private function getTotalResults($query, $type, $country_id, $city_id, $subject_id, $grade_id, $educational_stage_id = null, $student_type_id = null)
    {
        return $this->performSearch($query, $type, $country_id, $city_id, $subject_id, $grade_id, $educational_stage_id, $student_type_id)->count();
    }

    public function getCities(Request $request)
    {
        $cities = City::where('country_id', $request->country_id)->get();
        return response()->json($cities);
    }

    public function show($type, $id)
    {
        $details = null;
        
        switch ($type) {
            case 'teacher':
                $teacher = Teacher::with(['user', 'country', 'city', 'subjects'])
                    ->whereHas('user.subscription', function ($q) {
                        $q->where('status', 'active');
                    })
                    ->find($id);
                
                if ($teacher) {
                    $details = [
                        'type' => 'teacher',
                        'id' => $teacher->id,
                        'name' => $teacher->user->name,
                        'email' => $teacher->user->email,
                        'phone' => $teacher->user->phone,
                        'description' => $teacher->description,
                        'location' => $teacher->city->name_en . ', ' . $teacher->country->name_en,
                        'image' => $teacher->profile_image,
                        'degree' => $teacher->degree,
                        'experience' => $teacher->experience,
                        'subjects' => $teacher->subjects->pluck('name_en')->implode(', '),
                        'social_links' => $teacher->social_links,
                    ];
                }
                break;
                
            case 'educational_center':
                $center = EducationalCenter::with(['user', 'country', 'city', 'subjects'])
                    ->whereHas('user.subscription', function ($q) {
                        $q->where('status', 'active');
                    })
                    ->find($id);
                
                if ($center) {
                    $details = [
                        'type' => 'educational_center',
                        'id' => $center->id,
                        'name' => $center->user->name,
                        'email' => $center->user->email,
                        'phone' => $center->user->phone,
                        'description' => $center->description,
                        'location' => $center->city->name_en . ', ' . $center->country->name_en,
                        'image' => $center->logo,
                        'subjects' => $center->subjects->pluck('name_en')->implode(', '),
                        'social_links' => $center->social_links,
                    ];
                }
                break;
                
            case 'school':
                $school = School::with(['user', 'country', 'city', 'grades', 'educationalStages', 'studentTypes'])
                    ->whereHas('user.subscription', function ($q) {
                        $q->where('status', 'active');
                    })
                    ->find($id);
                
                if ($school) {
                    $details = [
                        'type' => 'school',
                        'id' => $school->id,
                        'name' => $school->user->name,
                        'email' => $school->user->email,
                        'phone' => $school->user->phone,
                        'description' => $school->description,
                        'location' => $school->city->name_en . ', ' . $school->country->name_en,
                        'image' => $school->logo,
                        'grades' => $school->grades->pluck('name_en')->implode(', '),
                        'educational_stages' => $school->educationalStages->pluck('name_ar')->implode(', '),
                        'student_types' => $school->studentTypes->pluck('name_ar')->implode(', '),
                        'social_links' => $school->social_links,
                    ];
                }
                break;
                
            case 'kindergarten':
                $kindergarten = Kindergarten::with(['user', 'country', 'city', 'grades'])
                    ->whereHas('user.subscription', function ($q) {
                        $q->where('status', 'active');
                    })
                    ->find($id);
                
                if ($kindergarten) {
                    $details = [
                        'type' => 'kindergarten',
                        'id' => $kindergarten->id,
                        'name' => $kindergarten->user->name,
                        'email' => $kindergarten->user->email,
                        'phone' => $kindergarten->user->phone,
                        'description' => $kindergarten->description,
                        'location' => $kindergarten->city->name_en . ', ' . $kindergarten->country->name_en,
                        'image' => $kindergarten->logo,
                        'grades' => $kindergarten->grades->pluck('name_en')->implode(', '),
                        'social_links' => $kindergarten->social_links,
                    ];
                }
                break;
                
            case 'nursery':
                $nursery = Nursery::with(['user', 'country', 'city'])
                    ->whereHas('user.subscription', function ($q) {
                        $q->where('status', 'active');
                    })
                    ->find($id);
                
                if ($nursery) {
                    $details = [
                        'type' => 'nursery',
                        'id' => $nursery->id,
                        'name' => $nursery->user->name,
                        'email' => $nursery->user->email,
                        'phone' => $nursery->user->phone,
                        'description' => $nursery->description,
                        'location' => $nursery->city->name_en . ', ' . $nursery->country->name_en,
                        'image' => $nursery->logo,
                        'ages' => $nursery->ages_accepted ? implode(', ', json_decode($nursery->ages_accepted)) : '',
                        'social_links' => $nursery->social_links,
                    ];
                }
                break;
        }
        
        if (!$details) {
            abort(404);
        }
        
        return view('search.details', compact('details'));
    }
}
