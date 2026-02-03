<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Teacher;
use App\Models\School;
use App\Models\EducationalCenter;
use App\Models\Kindergarten;
use App\Models\Nursery;
use App\Models\Country;
use App\Models\City;
use App\Models\Subject;
use App\Models\EducationalStage;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    /**
     * Search for teachers, schools, centers, etc.
     */
    public function search(Request $request)
    {
        $query = $request->input('query');
        $type = $request->input('type', 'all');
        $country_id = $request->input('country_id');
        $city_id = $request->input('city_id');
        $subject_id = $request->input('subject_id');
        $educational_stage_id = $request->input('educational_stage_id');
        $perPage = $request->input('per_page', 15);

        $results = [];

        if ($type === 'all' || $type === 'teacher') {
            $teachers = Teacher::with(['user', 'country', 'city', 'subjects'])
                ->whereHas('user', function($q) {
                    $q->where('is_active', true);
                })
                ->when($query, function($q) use ($query) {
                    $q->where('full_name', 'like', "%{$query}%")
                      ->orWhere('bio', 'like', "%{$query}%");
                })
                ->when($country_id, function($q) use ($country_id) {
                    $q->where('country_id', $country_id);
                })
                ->when($city_id, function($q) use ($city_id) {
                    $q->where('city_id', $city_id);
                })
                ->when($subject_id, function($q) use ($subject_id) {
                    $q->whereHas('subjects', function($sq) use ($subject_id) {
                        $sq->where('subjects.id', $subject_id);
                    });
                })
                ->paginate($perPage);

            $results['teachers'] = $teachers;
        }

        if ($type === 'all' || $type === 'school') {
            $schools = School::with(['user', 'country', 'city', 'grades', 'educationalStages'])
                ->whereHas('user', function($q) {
                    $q->where('is_active', true);
                })
                ->when($query, function($q) use ($query) {
                    $q->where('name', 'like', "%{$query}%")
                      ->orWhere('description', 'like', "%{$query}%");
                })
                ->when($country_id, function($q) use ($country_id) {
                    $q->where('country_id', $country_id);
                })
                ->when($city_id, function($q) use ($city_id) {
                    $q->where('city_id', $city_id);
                })
                ->when($educational_stage_id, function($q) use ($educational_stage_id) {
                    $q->whereHas('educationalStages', function($sq) use ($educational_stage_id) {
                        $sq->where('educational_stages.id', $educational_stage_id);
                    });
                })
                ->paginate($perPage);

            $results['schools'] = $schools;
        }

        if ($type === 'all' || $type === 'educational_center') {
            $centers = EducationalCenter::with(['user', 'country', 'city', 'subjects'])
                ->whereHas('user', function($q) {
                    $q->where('is_active', true);
                })
                ->when($query, function($q) use ($query) {
                    $q->where('name', 'like', "%{$query}%")
                      ->orWhere('description', 'like', "%{$query}%");
                })
                ->when($country_id, function($q) use ($country_id) {
                    $q->where('country_id', $country_id);
                })
                ->when($city_id, function($q) use ($city_id) {
                    $q->where('city_id', $city_id);
                })
                ->when($subject_id, function($q) use ($subject_id) {
                    $q->whereHas('subjects', function($sq) use ($subject_id) {
                        $sq->where('subjects.id', $subject_id);
                    });
                })
                ->paginate($perPage);

            $results['educational_centers'] = $centers;
        }

        if ($type === 'all' || $type === 'kindergarten') {
            $kindergartens = Kindergarten::with(['user', 'country', 'city', 'grades'])
                ->whereHas('user', function($q) {
                    $q->where('is_active', true);
                })
                ->when($query, function($q) use ($query) {
                    $q->where('name', 'like', "%{$query}%")
                      ->orWhere('description', 'like', "%{$query}%");
                })
                ->when($country_id, function($q) use ($country_id) {
                    $q->where('country_id', $country_id);
                })
                ->when($city_id, function($q) use ($city_id) {
                    $q->where('city_id', $city_id);
                })
                ->paginate($perPage);

            $results['kindergartens'] = $kindergartens;
        }

        if ($type === 'all' || $type === 'nursery') {
            $nurseries = Nursery::with(['user', 'country', 'city'])
                ->whereHas('user', function($q) {
                    $q->where('is_active', true);
                })
                ->when($query, function($q) use ($query) {
                    $q->where('name', 'like', "%{$query}%")
                      ->orWhere('description', 'like', "%{$query}%");
                })
                ->when($country_id, function($q) use ($country_id) {
                    $q->where('country_id', $country_id);
                })
                ->when($city_id, function($q) use ($city_id) {
                    $q->where('city_id', $city_id);
                })
                ->paginate($perPage);

            $results['nurseries'] = $nurseries;
        }

        return response()->json([
            'success' => true,
            'data' => $results
        ]);
    }

    /**
     * Get all countries
     */
    public function countries()
    {
        $countries = Country::orderBy('name_ar')->get();

        return response()->json([
            'success' => true,
            'data' => $countries
        ]);
    }

    /**
     * Get cities by country
     */
    public function cities($countryId)
    {
        $cities = City::where('country_id', $countryId)
            ->orderBy('name_ar')
            ->get();

        return response()->json([
            'success' => true,
            'data' => $cities
        ]);
    }

    /**
     * Get all subjects
     */
    public function subjects()
    {
        $subjects = Subject::orderBy('name_ar')->get();

        return response()->json([
            'success' => true,
            'data' => $subjects
        ]);
    }

    /**
     * Get all educational stages
     */
    public function educationalStages()
    {
        $stages = EducationalStage::orderBy('name_ar')->get();

        return response()->json([
            'success' => true,
            'data' => $stages
        ]);
    }
}
