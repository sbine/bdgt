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

Route::controllers([
    'auth'     => 'Auth\AuthController',
    'password' => 'Auth\PasswordController',
]);

Route::group(['middleware' => ['auth']], function () {

    Route::get('/', [
        'as' => 'index',
        'uses' => 'LedgerController@index',
    ]);

    Route::resource('accounts', 'AccountController');

    Route::resource('transactions', 'TransactionController');

    Route::resource('categories', 'CategoryController');

    Route::get('bills/ajax_calendar_events', 'BillController@ajax_calendar_events');
    Route::resource('bills', 'BillController');

    Route::resource('goals', 'GoalController');
});

Route::get('/calculators/debt', [
    'as' => 'calculators.debt',
    'uses' => 'CalculatorController@debt'
]);

Route::get('/calculators/savings', [
    'as' => 'calculators.savings',
    'uses' => 'CalculatorController@savings'
]);
