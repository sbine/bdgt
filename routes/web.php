<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
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
