<?php

use App\Http\Controllers\TransactionsController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    if (Auth::check()) {
        return view('home');
    }

    return view('welcome');
});

Auth::routes(['register' => false]);

Route::middleware(['auth'])->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/income', [App\Http\Controllers\IncomeController::class, 'index'])->name('income');
    Route::get('/budget', [App\Http\Controllers\BudgetController::class, 'index'])->name('budget');
    Route::get('/map', [App\Http\Controllers\MapController::class, 'index'])->name('map');

    Route::get('/loans', [App\Http\Controllers\LoansController::class, 'index'])->name('loans');
    Route::get('/costs', [App\Http\Controllers\CostsController::class, 'index'])->name('costs');
    Route::get('/fixedcosts', [App\Http\Controllers\FixedCostsController::class, 'index'])->name('fixedcosts');
    Route::get('/oneoffcosts', [App\Http\Controllers\OneOffCostsControllerr::class, 'index'])->name('oneoffcosts');

    Route::get('/settings', [App\Http\Controllers\SettingsController::class, 'index'])->name('settings');

    Route::resource('savings', App\Http\Controllers\SavingssController::class);
    Route::resource('transactions', TransactionsController::class);
});
