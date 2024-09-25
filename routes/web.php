<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\Api\BudgetController as ApiBudgetController;
use App\Http\Controllers\Api\TransactionController as ApiTransactionController;
use App\Http\Controllers\BillController;
use App\Http\Controllers\BillEventController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GoalController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\TransactionExportController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

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

Route::prefix(LaravelLocalization::setLocale())->group(function () {
    Route::view('/', 'page.index')->name('index');

    Route::middleware('auth')->group(function () {
        Route::get('dashboard', DashboardController::class)->name('dashboard');

        Route::view('budget', 'budget.index')->name('budget');

        // Accounts
        Route::resource('accounts', AccountController::class)->except('edit');

        // Transactions
        Route::resource('transactions', TransactionController::class)->only('store');
        Route::get('transactions/export', TransactionExportController::class)
            ->name('transactions.export')
            ->middleware('throttle:exports');

        // Categories
        Route::resource('categories', CategoryController::class)->except('edit');

        // Bills
        Route::get('bills/ajax_calendar_events', BillEventController::class)
            ->name('bills.ajax.calendar.events');

        Route::resource('bills', BillController::class)->except('edit');

        // Goals
        Route::resource('goals', GoalController::class)->except('edit');

        // Reports
        Route::prefix('reports')->group(function () {
            Route::get('/', [ReportController::class, 'index'])->name('reports.index');
            Route::get('{type}', [ReportController::class, 'show'])->name('reports.show');
            Route::post('ajax/{type}', [ReportController::class, 'ajax'])->name('reports.ajax.report');
        });

        // "API" for Vue
        Route::prefix('api')->name('api.')->group(function () {
            Route::get('budget/{year}/{month}', [ApiBudgetController::class, 'index'])->name('budget.index');
            Route::get('budget/{year}/{month}/{category}', [ApiBudgetController::class, 'show'])->name('budget.show');
            Route::post('budget/{year}/{month}/{category}', [ApiBudgetController::class, 'update'])->name('budget.update');
            Route::delete('budget/{year}/{month}/{category}', [ApiBudgetController::class, 'destroy'])->name('budget.destroy');

            Route::apiResource('transactions', ApiTransactionController::class);
        });
    });

    // Calculators
    Route::view('calculators/debt', 'calculator.debt')->name('calculators.debt');
    Route::view('calculators/savings', 'errors.coming_soon')->name('calculators.savings');
});

require __DIR__ . '/auth.php';
