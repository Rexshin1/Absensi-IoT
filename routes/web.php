<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::controller(DashboardController::class)->group(function () {
    Route::get('/', 'index')->name('dashboard');

    Route::prefix('utilities')->name('utilities.')->group(function () {
        Route::get('typography', 'typography')->name('typography');
        Route::get('table', 'table')->name('table');
        Route::get('form', 'form')->name('form');
        Route::get('shadow', 'shadow')->name('shadow');
    });

    Route::get('user-profile', 'profile')->name('profile');
    Route::post('user-profile', 'updateProfile')->name('profile.update');
    Route::get('master-data', 'masterData')->name('master-data.index');
    Route::get('students/create', 'students')->name('students.create');
    Route::get('students', 'studentList')->name('students.index');
    Route::post('students', 'storeStudent')->name('students.store');
    Route::get('attendance/recap', 'attendanceRecap')->name('attendance.recap');
    Route::get('apps/notes', 'notes')->name('apps.notes');
    Route::get('apps/tickets', 'tickets')->name('apps.tickets');
    Route::get('apps/tickets/create', 'createTicket')->name('apps.tickets.create');
    Route::get('apps/blog/post', 'blogPost')->name('apps.blog.post');
    Route::get('apps/blog/detail/{slug}', 'blogDetail')->name('apps.blog.detail');
    Route::get('auth/login', 'login')->name('login');
    Route::get('auth/register', 'register')->name('register');
});
