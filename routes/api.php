<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AttendanceController;
use App\Http\Controllers\Api\EnrollmentController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/device/mode', [EnrollmentController::class, 'getMode']);
Route::post('/device/mode', [EnrollmentController::class, 'setMode']);
Route::get('/fingerprint/cek-nama/{id}', [EnrollmentController::class, 'checkName']);
Route::post('/fingerprint/enroll', [EnrollmentController::class, 'enroll']);
Route::post('/attendance', [AttendanceController::class, 'store']);
Route::post('/attendances', [AttendanceController::class, 'store']);
