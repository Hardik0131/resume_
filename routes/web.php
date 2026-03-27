<?php

use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\ListingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ResumeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use PHPUnit\Framework\Constraint\IsEqualWithDelta;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/dashboard', function () {
        return view('dashboard');
    });

    // redirecting user to their respective dashboards based on their role
    Route::get('/dashboard', function(){
        $role = Auth::user()->role;

        return match($role){
            'admin' => redirect('/admin/dashboard'),
            'user' => redirect('employer/dashboard'),
            default => redirect('jobseeker/dashboard'),
        };
    });

    // Admin Dashboard Route
    Route::middleware('role:admin')->group(function(){
        Route::get('admin/dashboard', function(){
            return view('dashboard');
        })->name('dashboard');
    });

    // Employer Dashboard Routes
    Route::middleware('role:employer')->group(function(){
        Route::get('employer/dashboard', function(){
            return view('dashboard');
        })->name('dashboard');

        Route::get('employer/job/create', [ListingController::class, 'index'])->name('listing.create');
        Route::post('employer/job/create', [ListingController::class, 'store'])->name('listing.store');
        Route::get('employer/job/{id}/applicants', [ListingController::class, 'applicants'])->name('listing.applicants');
    });

    // Jobseeker Dashboard Routes
    Route::middleware('role:job_seeker')->group(function(){
        Route::get('jobseeker/dashboard', function(){
            return view('dashboard');
        })->name('dashboard');

        // Resume Upload Routes
        Route::get('jobseeker/upload-resume', [ResumeController::class, 'create'])->name('resume.create');
        Route::post('jobseeker/upload-resume', [ResumeController::class, 'store'])->name('resume.store');
        Route::get('/apply/{job}', [ApplicationController::class, 'apply'])->name('job.apply');
        Route::get('/jobs', [ListingController::class, 'job'])->name('job.show');
    });
});

require __DIR__ . '/auth.php';
