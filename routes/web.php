<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

use App\Http\Controllers\ProjectController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\CompareController;

use App\Models\Project;
use App\Models\News;

Route::get('/', [ProjectController::class, 'home'])->name('home');

Route::get('/project', [ProjectController::class, 'allProjects'])->name('all_project');
Route::get('/projects/filter', [ProjectController::class, 'filter'])->name('projects.filter');
Route::get('/projects/{id}', [ProjectController::class, 'show'])->name('project');
Route::get('/projects/{id}/apartments', [ProjectController::class, 'filterApartments'])->name('project.filterApartments');

Route::get('/news/{id}', [NewsController::class, 'show'])->name('news');

Route::get('/app', fn() => view('layouts/app'));

Route::middleware('auth')->group(function () {
    Route::get('/account', function () {
        $user = Auth::user();
        $favorites = $user->favorites()->with(['project', 'media'])->get();
        return view('account', compact('user', 'favorites'));
    })->name('profile');

    Route::put('/profile/phone', [AuthController::class, 'updatePhone'])->name('profile.updatePhone');
    Route::put('/profile/email', [AuthController::class, 'updateEmail'])->name('profile.updateEmail');
    Route::put('/profile/password', [AuthController::class, 'updatePassword'])->name('profile.updatePassword');

    Route::delete('/favorites/{apartment}', [FavoriteController::class, 'destroy']);
    Route::post('/favorites/add', [FavoriteController::class, 'add'])->name('favorites.add');

    Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
        $request->fulfill();
        return redirect('/');
    })->middleware('signed')->name('verification.verify');

    Route::post('/email/verification-notification', function (Request $request) {
        $request->user()->sendEmailVerificationNotification();
        return back()->with('message', 'Письмо отправлено!');
    })->middleware('throttle:6,1')->name('verification.send');

    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    
    Route::post('/update-phone', [AuthController::class, 'updatePhone'])->name('update.phone');
    Route::post('/update-email', [AuthController::class, 'updateEmail'])->name('update.email');
    Route::post('/update-password', [AuthController::class, 'updatePassword'])->name('update.password');
});

Route::get('/auth-toggle', fn() => view('auth/register'))->name('auth.toggle');

Route::get('/login', fn() => view('auth/register'))->name('login.form');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/register', [AuthController::class, 'register'])->name('register');


Route::get('/compare', [CompareController::class, 'index'])->name('compare.view');
Route::post('/compare/add/{apartment}', [CompareController::class, 'add'])->name('compare.add');
Route::delete('/compare/remove/{apartment}', [CompareController::class, 'remove'])->name('compare.remove');
