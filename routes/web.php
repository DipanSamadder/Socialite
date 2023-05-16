<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LoginController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/clear', function() {
    $exitCode = Artisan::call('route:cache');
    $exitCode = Artisan::call('config:cache');
    $exitCode = Artisan::call('cache:clear');
    $exitCode = Artisan::call('view:clear');
    return 'View cache cleared';
});
 
Route::get('login3', [LoginController::class, 'index'])->name('index.login');
Route::get('/login/github', [LoginController::class, 'redirectToProvider'])->name('github.login');
 
Route::get('/login/github/callback-url', [LoginController::class, 'handleProviderCallback']);

Route::get('/login/google', [LoginController::class, 'redirectToProviderGoogle'])->name('google.login');
 
Route::get('/login/google/callback', [LoginController::class, 'handleProviderCallbackGoogle']);

Route::get('/login/facebook', [LoginController::class, 'redirectToProviderFacebook'])->name('facebook.login');
 
Route::get('/login/facebook/callback', [LoginController::class, 'handleProviderCallbackFacebook']);


Route::get('/login/linkedin', [LoginController::class, 'redirectToProviderLinkedin'])->name('linkedin.login');
 
Route::get('/login/linkedin/callback', [LoginController::class, 'handleProviderCallbackLinkedin']);


Route::get('/login/instagram', [LoginController::class, 'redirectToInstagramProvider'])->name('instagram.login');
 
Route::get('/login/instagram/callback', [LoginController::class, 'instagramProviderCallback']);

Route::get('/login/twitter', [LoginController::class, 'redirectToTwitterProvider'])->name('twitter.login');
 
Route::get('/login/twitter/callback', [LoginController::class, 'twitterProviderCallback']);

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
