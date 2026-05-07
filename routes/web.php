<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\AdminController;

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post')->middleware('throttle:10,1');

Route::get('/admin/login', [AdminController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [AdminController::class, 'login'])->name('admin.login.post')->middleware('throttle:5,1');
Route::post('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');

Route::middleware(['auth'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/news', [NewsController::class, 'index'])->name('news.index');
    Route::get('/news/{news}', [NewsController::class, 'show'])->name('news.show');
    Route::get('/attendance', [App\Http\Controllers\AttendanceController::class, 'studentIndex'])->name('attendance.student');
    Route::get('/attendance/teacher', [App\Http\Controllers\AttendanceController::class, 'teacherIndex'])->name('attendance.teacher');
    Route::get('/attendance/mark/{scheduleId}', [App\Http\Controllers\AttendanceController::class, 'markForm'])->name('attendance.mark');
    Route::post('/attendance/mark/{scheduleId}', [App\Http\Controllers\AttendanceController::class, 'markStore'])->name('attendance.store');
    Route::get('/schedule', [ScheduleController::class, 'index'])->name('schedule.index');
    Route::post('/schedule', [ScheduleController::class, 'store'])->name('schedule.store');
    Route::delete('/schedule/{schedule}', [ScheduleController::class, 'destroy'])->name('schedule.destroy');
    Route::get('/settings', [SettingsController::class, 'index'])->name('settings.index');
    Route::post('/settings', [SettingsController::class, 'update'])->name('settings.update');
});

Route::middleware(['admin.auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('index');
    Route::get('/users/create', [AdminController::class, 'createUser'])->name('users.create');
    Route::post('/users', [AdminController::class, 'storeUser'])->name('users.store');
    Route::get('/users/{user}/edit', [AdminController::class, 'editUser'])->name('users.edit');
    Route::put('/users/{user}', [AdminController::class, 'updateUser'])->name('users.update');
    Route::delete('/users/{user}', [AdminController::class, 'destroyUser'])->name('users.destroy');
    Route::post('/news/{news}/toggle', [AdminController::class, 'toggleNews'])->name('news.toggle');
    Route::get('/news/create', [AdminController::class, 'createNews'])->name('admin.news.create');
    Route::post('/news', [AdminController::class, 'storeNews'])->name('admin.news.store');
    Route::delete('/news/{news}', [AdminController::class, 'destroyNews'])->name('news.destroy');
});

Route::get('/password/reset', fn() => redirect('/login'))->name('password.request');
Route::get('/', fn() => redirect('/dashboard'));

Route::get('/docs', function() { return view('swagger'); })->name('docs');

Route::get('/api-docs.json', function() {
    return response()->file(public_path('api-docs.json'), ['Content-Type' => 'application/json']);
})->name('api.docs.json');
