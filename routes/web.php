<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Client\DashboardController as ClientDashboardController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Models\User;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Public routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');

// Authentication routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);

    // Registration routes
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);
});

// Protected routes
Route::middleware('auth')->group(function () {
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    // Email verification routes
    Route::get('/email/verify', function () {
        return Inertia::render('Auth/VerifyEmail');
    })->name('verification.notice');

    Route::get('/email/verify/{id}/{hash}', function (Request $request) {
        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->intended(
                $request->user()->isAdmin() ? route('admin.dashboard') : route('client.dashboard')
            );
        }

        if ($request->user()->markEmailAsVerified()) {
            event(new \Illuminate\Auth\Events\Verified($request->user()));
        }

        return redirect()->intended(
            $request->user()->isAdmin() ? route('admin.dashboard') : route('client.dashboard')
        )->with('verified', true);
    })->middleware(['signed'])->name('verification.verify');

    Route::post('/email/verification-notification', function (Request $request) {
        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->intended(
                $request->user()->isAdmin() ? route('admin.dashboard') : route('client.dashboard')
            );
        }

        $request->user()->sendEmailVerificationNotification();

        return back()->with('status', 'verification-link-sent');
    })->middleware(['throttle:6,1'])->name('verification.send');
});

// Client routes
Route::prefix('client')
    ->name('client.')
    ->middleware(['auth', 'verified', 'check.role:client'])
    ->group(function () {
        Route::get('/dashboard', [ClientDashboardController::class, 'index'])->name('dashboard');
        Route::get('/quotes', function () {
            return Inertia::render('Client/Quotes/Index');
        })->name('quotes');
        Route::get('/equipment', function () {
            return Inertia::render('Client/Equipment/Index');
        })->name('equipment');
        Route::get('/receipts', function () {
            return Inertia::render('Client/Receipts/Index');
        })->name('receipts');
    });

// Admin routes
Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth', 'verified', 'check.role:admin'])
    ->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    });

Route::get('/check-email', function (Request $request) {
    $email = $request->query('email');
    $exists = User::where('email', $email)->exists();
    return response()->json(['exists' => $exists]);
})->name('check-email');
