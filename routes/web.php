<?php

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

Route::get('/', 'PageController@index')->name('index');

Route::group(['middleware' => ['auth']], function () {
    Route::get('dashboard', DashboardController::class)->name('dashboard');

    /*
     | Accounts
     */
    Route::resource('accounts', 'AccountController');

    /*
     | Transactions
     */
    Route::resource('transactions', 'TransactionController')->except('index');

    /*
     | Categories
     */
    Route::resource('categories', 'CategoryController');

    /*
     | Bills
     */
    Route::get('bills/ajax_calendar_events', BillEventController::class)
        ->name('bills.ajax.calendar.events');

    Route::resource('bills', 'BillController');

    /*
     | Goals
     */
    Route::resource('goals', 'GoalController');

    /*
     | Reports
     */
    Route::resource('reports', 'ReportController');

    Route::group(['prefix' => 'reports'], function () {
        Route::get('/', 'ReportController@index')->name('reports.index');

        Route::get('{type}', 'ReportController@show')->name('reports.show');

        Route::post('ajax/{type}', 'ReportController@ajax')->name('reports.ajax.report');
    });

    Route::prefix('api')->name('api.')->namespace('Api')->group(function () {
        Route::resource('transactions', 'TransactionController');
    });
});

/*
 | Calculators
 */
Route::get('calculators/debt', 'CalculatorController@debt')->name('calculators.debt');

Route::get('calculators/savings', 'CalculatorController@savings')->name('calculators.savings');
