<?php

use App\Http\Controllers\ProblemController;
use App\Http\Controllers\BalanceController;
use App\Http\Controllers\CompteController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\AdminReportController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\EmailVerificationController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\BilanController;
use App\Http\Controllers\EntryController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ComptableController;
use App\Http\Controllers\JournalController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CompteResultatController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ReportController;

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

Route::get('forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('forgot.password');
Route::post('forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('forgot.password.email');


// Login Routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Protecting routes with 'auth' middleware
Route::middleware(['auth'])->group(function () {
    // Home Route
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    // Our-Servuce
    Route::get('/our-service', [ServiceController::class, 'index'])->name('OurService');
    Route::get('/AdminService', [ServiceController::class, 'ServiceAdmin'])->name('ServiceAdmin');
    Route::post('/CreateCompany', [CompanyController::class, 'createBilan'])->name('create_Company');
    Route::get('/FournisseurService', [ServiceController::class, 'ServiceFournisseur'])->name('ServiceFournisseur');
    Route::post('/products', [ProductController::class, 'store'])->name('Add_Product');

    // Define routes for CompteResultatController
    Route::get('/compte-resultat', [CompteResultatController::class, 'index'])->name('compte-resultat.index');
    Route::post('/compte-resultat', [CompteResultatController::class, 'store'])->name('compte-resultat.store');
    Route::put('/compte-resultat/{id}', [CompteResultatController::class, 'update'])->name('compte-resultat.update');
    Route::delete('/compte-resultat/{id}', [CompteResultatController::class, 'destroy'])->name('compte-resultat.destroy');

    // Balance
    Route::get('/balances', [BalanceController::class, 'index'])->name('balances.index');

    // Grand Livre
    Route::resource('entries', EntryController::class);

    // Define routes for Admin and SuperAdmin dashboards
    Route::get('/admin/dashboard', [HomeController::class, 'adminDashboard'])->name('admin.dashboard');
    Route::get('/comptable/dashboard', [ComptableController::class, 'dashboard'])->name('comptable.dashboard');
    Route::get('/superadmin/dashboard', [HomeController::class, 'superAdminDashboard'])->name('superadmin.dashboard');

    // create Company
    Route::post('/create-company', [CompanyController::class, 'createCompany'])->name('create.company');
    Route::get('/email/verify/{token}', [EmailVerificationController::class, 'verify'])->name('confirmation.route');

    // plan comptable
    Route::get('/comptes', [CompteController::class, 'index'])->name('comptes.index');
    Route::post('/comptes', [CompteController::class, 'store'])->name('comptes.store');
    Route::get('/comptes/{compte}', [CompteController::class, 'show'])->name('comptes.show');
    Route::put('/comptes/{compte}', [CompteController::class, 'update'])->name('comptes.update');
    Route::delete('/comptes/{compte}', [CompteController::class, 'destroy'])->name('comptes.destroy');

    // journal
    Route::get('/journals', [JournalController::class, 'index'])->name('journals.index');
    Route::post('/journals', [JournalController::class, 'store'])->name('journals.store');
    Route::get('/journals/{id}', [JournalController::class, 'show'])->name('journals.show');
    Route::put('/journals/{id}', [JournalController::class, 'update'])->name('journals.update');
    Route::delete('/journals/{id}', [JournalController::class, 'destroy'])->name('journals.destroy');
    Route::post('/journals/import', [JournalController::class, 'import'])->name('journals.import');

    // Bilan
    Route::get('bilan', [BilanController::class, 'index'])->name('bilan.index');

    // Rapport
    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
    Route::post('/reports', [ReportController::class, 'createReport'])->name('reports.create');
    Route::put('/reports/{id}', [ReportController::class, 'updateReport'])->name('reports.update');
    Route::delete('/reports/{id}', [ReportController::class, 'deleteReport'])->name('reports.delete');
    Route::get('/reports/{id}/export', [ReportController::class, 'exportReportToPDF'])->name('reports.export');

    // Admin Rapport
    Route::get('/admin_reports', [AdminReportController::class, 'index'])->name('admin_reports.index');
    Route::patch('/admin_reports/{id}/mark_as_read', [AdminReportController::class, 'markAsRead'])->name('admin_reports.markAsRead');
    Route::get('/admin_reports/{id}/export', [AdminReportController::class, 'exportReportToPDF'])->name('admin_reports.export');

    // order
    Route::get('/commandes', [OrderController::class, 'showOrders'])->name('orders.index');

    // Produits
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');

    // orders
    Route::get('/orders/{id}', 'OrdersController@show')->name('orders.show');
    Route::post('/orders', [OrderController::class, 'createOrder'])->name('orders.create');
    Route::post('/orders/{id}/complete', [OrderController::class, 'markAsComplete'])->name('orders.complete');
    Route::get('notify-fournisseurs/{productId}', [OrderController::class, 'notifyFournisseurs']);
    Route::delete('/orders/{id}', [OrderController::class, 'deleteOrder'])->name('orders.delete');


    // Contact us message
    Route::post('/contact/send', [ContactController::class, 'send'])->name('contact.send');


    // Problem
    Route::get('/problems', [ProblemController::class, 'index'])->name('problems.index');
    Route::post('/problems', [ProblemController::class, 'store'])->name('problems.store');
});
