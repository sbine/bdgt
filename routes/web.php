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

Route::get('/', [
    'as' => 'index',
    'uses' => 'PageController@index',
]);

Route::group(['middleware' => ['auth']], function () {
    Route::get('/dashboard', [
        'as' => 'dashboard',
        'uses' => 'LedgerController@index',
    ]);

    /*
     | Accounts
     */
    Route::resource('accounts', 'AccountController');

    /*
     | Transactions
     */
    Route::resource('transactions', 'TransactionController');

    /*
     | Categories
     */
    Route::resource('categories', 'CategoryController');

    /*
     | Bills
     */
    Route::get('bills/ajax_calendar_events', [
        'as' => 'bills.ajax.calendar.events',
        'uses' => 'BillController@ajax_calendar_events'
    ]);

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
        Route::get('/', [
            'as' => 'reports.index',
            'uses' => 'ReportController@index'
        ]);

        Route::get('/{type}', [
            'as' => 'reports.show',
            'uses' => 'ReportController@show'
        ]);

        Route::get('ajax/{type}', [
            'as' => 'reports.ajax.report',
            'uses' => 'ReportController@ajax_report'
        ]);

    });
});

/*
 | Calculators
 */
Route::get('/calculators/debt', [
    'as' => 'calculators.debt',
    'uses' => 'CalculatorController@debt'
]);

Route::get('/calculators/savings', [
    'as' => 'calculators.savings',
    'uses' => 'CalculatorController@savings'
]);
