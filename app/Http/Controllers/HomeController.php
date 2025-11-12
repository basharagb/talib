<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        // Handle language switching
        if ($request->has('lang')) {
            $locale = $request->get('lang');
            if (in_array($locale, ['ar', 'en'])) {
                session(['locale' => $locale]);
                app()->setLocale($locale);
            }
        } elseif (session('locale')) {
            app()->setLocale(session('locale'));
        }

        return view('home');
    }
}
