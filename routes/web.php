<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\WisataController;
use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\DestinationController;
use App\Http\Controllers\CategoryController;
use App\Models\Category;
use App\Models\Destination;

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

// Redirect root to login if not authenticated
Route::get('/', function () {
    if (auth()->check()) {
        if (auth()->user()->isAdmin()) {
            return redirect()->route('admin.dashboard');
        } else {
            return redirect()->route('home');
        }
    }
    return redirect()->route('login');
});

// Authentication Routes (Guest only)
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);
});

// All website features require authentication
Route::middleware('auth')->group(function () {
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    // Main website routes (READ ONLY - accessible by both admin and user)
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/wisata/{destination:slug}', [HomeController::class, 'show'])->name('wisata.show');
    Route::get('/search', [HomeController::class, 'search'])->name('search');

    // READ ONLY routes for destinations and categories
    Route::get('/destinations', [DestinationController::class, 'index'])->name('destinations.index');
    Route::get('/destinations/{destination}', [DestinationController::class, 'show'])->name('destinations.show');
    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('/categories/{category}', [CategoryController::class, 'show'])->name('categories.show');
    Route::get('/destinations/category/{category}', [DestinationController::class, 'byCategory'])->name('destinations.byCategory');
    Route::get('/destinations/filter', [DestinationController::class, 'filter'])->name('destinations.filter');

    // User Protected Routes (only for users)
    Route::middleware('role:user')->prefix('user')->name('user.')->group(function () {
        Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
        Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    });

    // Admin Protected Routes (only for admins)
    Route::middleware('role:admin')->prefix('admin')->name('admin.')->group(function () {
        // Dashboard
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        // Wisata Management
        Route::resource('wisata', WisataController::class)->parameters([
            'wisata' => 'wisata'
        ]);

        // Destinations & Categories Management (CRUD - Admin only)
        Route::post('/destinations', [DestinationController::class, 'store'])->name('destinations.store');
        Route::get('/destinations/create', [DestinationController::class, 'create'])->name('destinations.create');
        Route::get('/destinations/{destination}/edit', [DestinationController::class, 'edit'])->name('destinations.edit');
        Route::put('/destinations/{destination}', [DestinationController::class, 'update'])->name('destinations.update');
        Route::delete('/destinations/{destination}', [DestinationController::class, 'destroy'])->name('destinations.destroy');

        Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
        Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
        Route::get('/categories/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
        Route::put('/categories/{category}', [CategoryController::class, 'update'])->name('categories.update');
        Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');

        // User Management
        Route::get('/users', [UserController::class, 'index'])->name('users.index');
        Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');
        Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');

        // Admin Management
        Route::get('/admins', [UserController::class, 'admins'])->name('admins.index');

        // Admin Profile
        Route::get('/profile', [UserController::class, 'editProfile'])->name('profile.edit');
        Route::put('/profile', [UserController::class, 'updateProfile'])->name('profile.update');
    });
});
