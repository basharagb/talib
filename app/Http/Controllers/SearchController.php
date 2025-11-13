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
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $countries = Country::all();
        $subjects = Subject::all();
        $grades = Grade::all();
        
        $results = [];
        $query = $request->get('q');
        $type = $request->get('type');
        $country_id = $request->get('country_id');
        $city_id = $request->get('city_id');
        $subject_id = $request->get('subject_id');
        $grade_id = $request->get('grade_id');

        if ($query || $type || $country_id || $city_id || $subject_id || $grade_id) {
            $results = $this->performSearch($query, $type, $country_id, $city_id, $subject_id, $grade_id);
        }

        return view('search.index', compact(
            'results', 'query', 'type', 'countries', 'subjects', 'grades',
            'country_id', 'city_id', 'subject_id', 'grade_id'
        ));
    }

    private function performSearch($query, $type, $country_id, $city_id, $subject_id, $grade_id)
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
            $schools = School::with(['user', 'country', 'city', 'grades'])
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

    public function getCities(Request $request)
    {
        $cities = City::where('country_id', $request->country_id)->get();
        return response()->json($cities);
    }
}
