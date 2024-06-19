<?php

use App\Http\Controllers\ServiceController;


use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\OperationController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\JournalController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CompteResultatController;





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

Route::get('/', function () {
    return redirect()->route('login');
});

// Authentication Routes
// Auth::routes();

// Registration Routes
Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);
Route::get('confirmation/{token}', [RegisterController::class, 'confirmEmail'])->name('confirmation');

Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');

// Use a different route name for forgot password to avoid conflict with password reset routes
Route::get('forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('forgot.password');
Route::post('forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('forgot.password.email');

// Login Routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Home Route
Route::get('/home', [HomeController::class, 'index'])->name('home');

// Our-Servuce
Route::get('/our-service', [ServiceController::class, 'index'])->name('OurService');
Route::get('/AdminService', [ServiceController::class, 'ServiceAdmin'])->name('ServiceAdmin');
Route::post('/CreateCompany', [CompanyController::class, 'createBilan'])->name('create_Company');
Route::get('/FournisseurService', [ServiceController::class, 'ServiceFournisseur'])->name('ServiceFournisseur');
Route::post('/products', [ProductController::class, 'store'])->name('Add_Product');

// Journal
Route::get('/journals', [JournalController::class, 'index']);
Route::post('/journals', [JournalController::class, 'store']);
Route::put('/journals/{id}', [JournalController::class, 'update']);
Route::delete('/journals/{id}', [JournalController::class, 'destroy']);



// Define routes for CompteResultatController
Route::resource('compte-resultat', CompteResultatController::class);


// Balance
Route::resource('balance', 'BalanceController');

// Grand Livre
Route::resource('accounts', AccountController::class);
Route::resource('operations', OperationController::class);



// Define routes for Admin and SuperAdmin dashboards
Route::get('/admin/dashboard', [HomeController::class, 'adminDashboard'])->name('admin.dashboard');
Route::get('/Comptable/dashboard', [HomeController::class, 'ComptableDashboard'])->name('Comptable.dashboard');
Route::get('/superadmin/dashboard', [HomeController::class, 'superAdminDashboard'])->name('superadmin.dashboard');


// Company create
Route::post('/create_bilan', [CompanyController::class, 'createBilan'])->name('create_bilan');
