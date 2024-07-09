<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;

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


Route::middleware('guest')->group(function () {
    Route::get('/', function () {
        return view('auth.login');
    });
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/home', function () {
        if (Auth::check()) {
            if (Auth::user()->role == 'admin') {
                return (new DashboardController)->admin();
            } else {
                return (new DashboardController)->admin();
            }
        } else {
            return view('auth.login');
        }
    })->name('home');

    Route::get('/edit-profile', function () {
        return view('profile.index');
    })->name('profile.edit');
    Route::put('/edit-profile/{id}', [App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');

    Route::middleware('can:admin')->group(function () {
        Route::resource('setting-users', App\Http\Controllers\SettingUserController::class);
        Route::resource('patients', App\Http\Controllers\PatientController::class);
        Route::get('/create-patient-excel', [App\Http\Controllers\PatientController::class, 'createExcel'])->name('patients.create-excel');
        Route::post('/store-patient-excel', [App\Http\Controllers\PatientController::class, 'storeExcel'])->name('patients.store-excel');
        Route::resource('criterias', App\Http\Controllers\CriteriaController::class);
        Route::resource('subcriterias', App\Http\Controllers\SubCriteriaController::class);

        Route::get('electre', [App\Http\Controllers\ElectreController::class, 'electre'])->name('electre');
    });

    Route::middleware('can:user')->group(function () {
    });
});
