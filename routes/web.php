<?php

use App\Http\Controllers\ProfileController;
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
            return view('admin.dashboard');
        })->name('admin.dashboard');
    });

    // Employer Dashboard Routes
    Route::middleware('role:employer')->group(function(){
        Route::get('employer/dashboard', function(){
            return view('employer.dashboard');
        })->name('employer.dashboard');
    });

    // Jobseeker Dashboard Routes
    Route::middleware('role:job_seeker')->group(function(){
        Route::get('jobseeker/dashboard', function(){
            return view('jobseeker.dashboard');
        })->name('jobseeker.dashboard');
    });
});

require __DIR__ . '/auth.php';
