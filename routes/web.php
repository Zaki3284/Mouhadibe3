<?php

use App\Http\Controllers\CompteController;
use App\Http\Controllers\ServiceController;


use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\EmailVerificationController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\OperationController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ComptableController;
use App\Http\Controllers\JournalController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CompteResultatController;
use App\Http\Controllers\RapportController;









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
Route::get('/confirmation/{token}', [RegisterController::class, 'confirmEmail'])->name('confirmation');




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
Route::get('/journals', [JournalController::class, 'index'])->name('journal');
Route::post('/journals', [JournalController::class, 'store'])->name('journal.store');
Route::put('/journals/{id}', [JournalController::class, 'update'])->name('journal.update');
Route::delete('/journals/{id}', [JournalController::class, 'destroy'])->name('journal.destroy');



// Define routes for CompteResultatController
Route::get('/compte-resultat', [CompteResultatController::class, 'index'])->name('compte-resultat.index');
Route::post('/compte-resultat', [CompteResultatController::class, 'store'])->name('compte-resultat.store');
Route::put('/compte-resultat/{id}', [CompteResultatController::class, 'update'])->name('compte-resultat.update');
Route::delete('/compte-resultat/{id}', [CompteResultatController::class, 'destroy'])->name('compte-resultat.destroy');



// Balance
Route::resource('balance', 'BalanceController');

// Grand Livre

Route::get('/accounts', [AccountController::class, 'index'])->name('accounts');
Route::get('/accounts/create', [AccountController::class, 'create'])->name('accounts.create');
Route::post('/accounts', [AccountController::class, 'store'])->name('accounts.store');
Route::get('/accounts/{account}', [AccountController::class, 'show'])->name('accounts.show');
Route::get('/accounts/{account}/edit', [AccountController::class, 'edit'])->name('accounts.edit');
Route::put('/accounts/{account}', [AccountController::class, 'update'])->name('accounts.update');
Route::delete('/accounts/{account}', [AccountController::class, 'destroy'])->name('accounts.destroy');

// Route::get('/operations', [OperationController::class, 'index'])->name('operations.index');
Route::get('/operations/create', [OperationController::class, 'create'])->name('operations.create');
Route::post('/operations', [OperationController::class, 'store'])->name('operations.store');
Route::get('/operations/{operation}', [OperationController::class, 'show'])->name('operations.show');
Route::get('/operations/{operation}/edit', [OperationController::class, 'edit'])->name('operations.edit');
Route::put('/operations/{operation}', [OperationController::class, 'update'])->name('operations.update');
Route::delete('/operations/{operation}', [OperationController::class, 'destroy'])->name('operations.destroy');



// Define routes for Admin and SuperAdmin dashboards
Route::get('/admin/dashboard', [HomeController::class, 'adminDashboard'])->name('admin.dashboard');

Route::get('/comptable/dashboard', [ComptableController::class, 'dashboard'])->name('comptable.dashboard');

Route::get('lang/{locale}', [App\Http\Controllers\LocalizationController::class, 'switch'])->name('lang.switch');

Route::get('/superadmin/dashboard', [HomeController::class, 'superAdminDashboard'])->name('superadmin.dashboard');

// create Company
Route::post('/create-company', [CompanyController::class, 'createCompany'])->name('create.company');
Route::get('/email/verify/{token}', [EmailVerificationController::class, 'verify'])->name('confirmation.route');



Route::get('/rapports', [RapportController::class, 'index'])->name('rapports.index');



// plan  comptable

Route::get('/comptes', [App\Http\Controllers\CompteController::class, 'index'])->name('comptes.index');
Route::post('/comptes', [App\Http\Controllers\CompteController::class, 'store'])->name('comptes.store');
Route::get('/comptes/{compte}/edit', [App\Http\Controllers\CompteController::class, 'edit'])->name('comptes.edit');
Route::put('/comptes/{id}', [App\Http\Controllers\CompteController::class, 'update'])->name('comptes.update');
Route::delete('/comptes/{id}', [App\Http\Controllers\CompteController::class, 'destroy'])->name('comptes.destroy');
