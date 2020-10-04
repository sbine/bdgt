<?php

use Illuminate\Support\Facades\Route;

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

Auth::routes();

Route::view('/', 'page.index')->name('index');

Route::group(['middleware' => ['auth']], function () {
    Route::get('dashboard', 'DashboardController')->name('dashboard');

    Route::view('budget', 'budget.index')->name('budget');

    // Accounts
    Route::resource('accounts', 'AccountController');

    // Transactions
    Route::resource('transactions', 'TransactionController')->except('index');

    // Categories
    Route::resource('categories', 'CategoryController');

    // Bills
    Route::get('bills/ajax_calendar_events', 'BillEventController')
        ->name('bills.ajax.calendar.events');

    Route::resource('bills', 'BillController');

    // Goals
    Route::resource('goals', 'GoalController');

    // Reports
    Route::resource('reports', 'ReportController')->except(['index', 'show']);

    Route::group(['prefix' => 'reports'], function () {
        Route::get('/', 'ReportController@index')->name('reports.index');

        Route::get('{type}', 'ReportController@show')->name('reports.show');

        Route::post('ajax/{type}', 'ReportController@ajax')->name('reports.ajax.report');
    });

    // "API" for Vue
    Route::prefix('api')->name('api.')->namespace('Api')->group(function () {
        Route::get('budget/{year}/{month}', 'BudgetController@index')->name('budget.index');
        Route::get('budget/{year}/{month}/{category}', 'BudgetController@show')->name('budget.show');
        Route::post('budget/{year}/{month}/{category}', 'BudgetController@update')->name('budget.update');
        Route::delete('budget/{year}/{month}/{category}', 'BudgetController@destroy')->name('budget.destroy');

        Route::resource('transactions', 'TransactionController');
    });
});

// Calculators
Route::view('calculators/debt', 'calculator.debt')->name('calculators.debt');

Route::view('calculators/savings', 'errors.coming_soon')->name('calculators.savings');
