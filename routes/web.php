<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\LocaleController;
use App\Http\Controllers\Registration\TeacherRegistrationController;
use App\Http\Controllers\Registration\EducationalCenterRegistrationController;
use App\Http\Controllers\Registration\SchoolRegistrationController;
use App\Http\Controllers\Registration\KindergartenRegistrationController;
use App\Http\Controllers\Registration\NurseryRegistrationController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home');

// Language switching route
Route::get('/locale/{locale}', [LocaleController::class, 'switch'])->name('locale.switch');

// Search Routes (with rate limiting for public access)
Route::get('/search', [SearchController::class, 'index'])->name('search')->middleware('throttle:60,1');
Route::get('/search/cities/{country}', [SearchController::class, 'getCities'])->name('search.cities')->middleware('throttle:100,1');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Registration Routes
Route::prefix('register')->name('register.')->group(function () {
    // Teacher Registration
    Route::get('/teacher', [TeacherRegistrationController::class, 'showRegistrationForm'])->name('teacher');
    Route::post('/teacher', [TeacherRegistrationController::class, 'register'])->name('teacher.store');
    
    // Educational Center Registration
    Route::get('/educational-center', [EducationalCenterRegistrationController::class, 'showRegistrationForm'])->name('educational-center');
    Route::post('/educational-center', [EducationalCenterRegistrationController::class, 'register'])->name('educational-center.store');
    
    // School Registration
    Route::get('/school', [SchoolRegistrationController::class, 'showRegistrationForm'])->name('school');
    Route::post('/school', [SchoolRegistrationController::class, 'register'])->name('school.store');
    
    // Kindergarten Registration
    Route::get('/kindergarten', [KindergartenRegistrationController::class, 'showRegistrationForm'])->name('kindergarten');
    Route::post('/kindergarten', [KindergartenRegistrationController::class, 'register'])->name('kindergarten.store');
    
    // Nursery Registration
    Route::get('/nursery', [NurseryRegistrationController::class, 'showRegistrationForm'])->name('nursery');
    Route::post('/nursery', [NurseryRegistrationController::class, 'register'])->name('nursery.store');
    
    // AJAX Routes for dynamic data
    Route::get('/cities/{country}', [TeacherRegistrationController::class, 'getCities'])->name('cities');
});

// Payment Routes
Route::middleware('auth')->prefix('payment')->name('payment.')->group(function () {
    Route::get('/{subscription}', [PaymentController::class, 'show'])->name('show');
    Route::post('/{subscription}', [PaymentController::class, 'process'])->name('process');
    Route::get('/{payment}/success', [PaymentController::class, 'success'])->name('success');
    Route::get('/{payment}/cancel', [PaymentController::class, 'cancel'])->name('cancel');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
