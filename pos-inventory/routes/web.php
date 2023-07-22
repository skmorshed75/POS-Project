<?php

use App\Http\Controllers\UserController;
use App\Http\Middleware\TokenVerificationMiddleware;
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
// Route::get('/',function () {
//     return view();
// });

//Web API Routes
Route::post('/user-login',[UserController::class,'UserLogin']);
Route::post('/UserRegistration',[UserController::class,'UserRegistration']);
Route::post('/SendOTPToEmail',[UserController::class,'SendOTPToEmail']);
Route::post('/OTPVerify',[UserController::class,'OTPVerify']);
//Token verify for password reset
Route::post('/ResetPassword',[UserController::class,'ResetPassword'])->middleware(TokenVerificationMiddleware::class);
Route::post('/ProfileUpdate',[UserController::class,'ProfileUpdate']);

//Page Routes
Route::get('/userLogin',[UserController::class,'LoginPage']);
Route::get('/userRegistration',[UserController::class,'RegistrationPage']);
Route::get('/sendOtp',[UserController::class,'SendOtpPage']);
Route::get('/verifyOtp',[UserController::class,'VerifyOtpPage']);
Route::get('/resetPassword',[UserController::class,'ResetPasswordPage']);
Route::get('/dashboard',[UserController::class,'DashboardPage']);


