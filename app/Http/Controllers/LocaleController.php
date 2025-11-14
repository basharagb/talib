<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

class LocaleController extends Controller
{
    /**
     * Switch the application locale
     *
     * @param Request $request
     * @param string $locale
     * @return \Illuminate\Http\RedirectResponse
     */
    public function switch(Request $request, $locale)
    {
        // Get available locales from config
        $availableLocales = array_keys(config('app.available_locales'));
        
        // Check if the requested locale is available
        if (in_array($locale, $availableLocales)) {
            // Store the locale in session
            Session::put('locale', $locale);
        }
        
        // Redirect back to the previous page
        return Redirect::back();
    }
}
