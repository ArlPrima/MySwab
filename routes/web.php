<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\PaymentController;

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

# Guest pages (no need login)
Route::get('/', [PagesController::class, 'index'])->name('landing');

# Patient for Reservation
Route::get('/register', [PatientController::class, 'form'])->name('register');
Route::post('/register', [PatientController::class, 'register']);
Route::get('/general-information', [PatientController::class, 'formInformation'])->name('generalInformation');
Route::post('/general-information', [PatientController::class, 'storeInformation']);
Route::patch('/general-information', [PatientController::class, 'editInformation']);

# Payment
Route::prefix('payment')->group(function() {
    Route::get('/', [PaymentController::class, 'formCheck'])->name('payment');
    Route::post('/', [PaymentController::class, 'check']);
    Route::get('/{id}', [PaymentController::class, 'form'])->name('paymentForm');
    Route::post('/{id}', [PaymentController::class, 'store']);
});

# Login hospital staff
Route::get('/login-hospital', [AuthController::class, 'formLogin'])->name('login');
Route::post('/login-hospital', [AuthController::class, 'login']);

# Admin Controller
Route::group(['middleware' => 'auth'], function () {
    // Logout
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
    Route::post('logout', [AuthController::class, 'logout']);
    
    // Dashboard
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    
    // Result Patient
    Route::prefix('patient')->group(function() {
        Route::get('{id}', [AdminController::class, 'edit'])->name('editPatient');
        Route::post('{id}', [AdminController::class, 'store']);
        Route::patch('{id}', [AdminController::class, 'update']);
        Route::get('{id}/result', [AdminController::class, 'downloadResult'])->name('downloadResult');
        Route::get('{patient}/proof', [AdminController::class, 'downloadProof'])->name('downloadProof');
    });
});