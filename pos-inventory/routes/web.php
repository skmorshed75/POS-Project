<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Middleware\TokenVerificationMiddleware;

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
Route::post('/user-registration',[UserController::class,'UserRegistration']);
Route::post('/send-otp',[UserController::class,'SendOTPToEmail']);
Route::post('/otp-verify',[UserController::class,'OTPVerify']);
//Token verify for password reset
Route::post('/reset-password',[UserController::class,'ResetPassword'])->middleware(TokenVerificationMiddleware::class);

//AFter Authentication
Route::get('/user-profile-details',[UserController::class,'ProfileUpdate'])->middleware(TokenVerificationMiddleware::class);
Route::post('/user-update',[UserController::class,'UserUpdate'])->middleware(TokenVerificationMiddleware::class);


//User Logout
Route::get('/logout',[UserController::class,'UserLogout']);

//Page Routes
Route::get('/userLogin',[UserController::class,'LoginPage']);
Route::get('/userRegistration',[UserController::class,'RegistrationPage']);
Route::get('/sendOtp',[UserController::class,'SendOtpPage']);
Route::get('/verifyOtp',[UserController::class,'VerifyOtpPage']);
Route::get('/resetPassword',[UserController::class,'ResetPasswordPage'])->middleware(TokenVerificationMiddleware::class);
Route::get('/userProfile',[UserController::class,'ProfilePage'])->middleware(TokenVerificationMiddleware::class);

Route::get('/customerPage',[CustomerController::class,'CustomerPage'])->middleware(TokenVerificationMiddleware::class);
Route::get('/productPage',[ProductController::class,'ProductPage'])->middleware(TokenVerificationMiddleware::class);
Route::get('/categoryPage',[CategoryController::class,'CategoryPage'])->middleware(TokenVerificationMiddleware::class);

//After Authentication
Route::get('/dashboard',[DashboardController::class,'DashboardPage'])->middleware(TokenVerificationMiddleware::class);

//Customer API
Route::post("create-customer",[CustomerController::class,'CustomerCreate'])->middleware(TokenVerificationMiddleware::class);
Route::get("list-customer",[CustomerController::class,'CustomerList'])->middleware(TokenVerificationMiddleware::class);
Route::post("delete-customer",[CustomerController::class,'CustomerDelete'])->middleware(TokenVerificationMiddleware::class);
Route::post("update-customer",[CustomerController::class,'CustomerUpdate'])->middleware(TokenVerificationMiddleware::class);

//Category API
Route::post("create-category",[CategoryController::class,'CategoryCreate'])->middleware(TokenVerificationMiddleware::class);
Route::get("list-category",[CategoryController::class,'CategoryList'])->middleware(TokenVerificationMiddleware::class);
Route::post("delete-category",[CategoryController::class,'CategoryDelete'])->middleware(TokenVerificationMiddleware::class);
Route::post("update-category",[CategoryController::class,'CategoryUpdate'])->middleware(TokenVerificationMiddleware::class);

//Product API
Route::post("create-product",[ProductController::class,'ProductCreate'])->middleware(TokenVerificationMiddleware::class);
Route::get("list-product",[ProductController::class,'ProductList'])->middleware(TokenVerificationMiddleware::class);
Route::post("delete-product",[ProductController::class,'ProductDelete'])->middleware(TokenVerificationMiddleware::class);
Route::post("update-product",[ProductController::class,'ProductUpdate'])->middleware(TokenVerificationMiddleware::class);

//DASHBOARD API
Route::get("/total-customer",[DashboardController::class,'TotalCustomer'])->middleware(TokenVerificationMiddleware::class);
Route::get("/total-product",[DashboardController::class,'TotalProduct'])->middleware(TokenVerificationMiddleware::class);
Route::get("/total-category",[DashboardController::class,'TotalCategory'])->middleware(TokenVerificationMiddleware::class);