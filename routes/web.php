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

Route::get('', 'AuthController@index')->name('index');

Route::get('login', 'AuthController@login')->name('login');
Route::post('login', 'AuthController@processLogin');
Route::get('logout', 'AuthController@logout')->name('logout');


Route::post('otp-login', 'AuthController@loginOTP')->name('otp-login');

Route::get('verify/account/{code}', 'AuthController@verify')->name('verify-account');
Route::post('set-password', 'AuthController@setPassword')->name('set-password');

Route::middleware('auth')->group(function () {
    Route::get('dashboard', 'SystemAdminController@index')->name('dashboard');

    Route::get('sample-upload', 'UploadController@downloadSample')->name('sample-upload');

    Route::prefix('settings')->name('settings.')->group(function () {
        Route::get('/', 'SettingsController@index')->name('profile');
        Route::post('upload-avatar', 'SettingsController@create')->name('upload-avatar');
        Route::post('change-password', 'SettingsController@changePassword')->name('change-password');
    });

    Route::prefix('permissions')->name('permissions.')->group(function () {
        Route::get('/', 'PermissionController@index')->name('index');
    });

    Route::prefix('accounts')->name('account.')->group(function () {
        Route::get('completed-accounts', 'AccountsController@getAccountsSuccessful')->name('completed-accounts');
        Route::get('pending-accounts', 'AccountsController@getAccountsPending')->name('pending-accounts');
        Route::get('partially-approved', 'AccountsController@getAccountsPartiallyApproved')->name('partially-approved');
        Route::post('action-accounts', 'AccountsController@ApproveRejectAccount')->name('action-accounts');

    });

    Route::prefix('loans')->name('loan.')->group(function () {
        Route::get('new', 'LoansController@getloansPending')->name('new');
        Route::get('active', 'LoansController@getActiveLoans')->name('active');
        Route::get('paid', 'LoansController@getPaidLoans')->name('paid');
        Route::get('rejected-loans', 'LoansController@getRejectedLoans')->name('rejected-loans');
        Route::post('action-loan', 'LoansController@ActionLoan')->name('action-loan');
        Route::get('loan-details', 'LoansController@getLoanDetails')->name('loan-details');
        Route::get('partially', 'LoansController@getPartiallyLoans')->name('partially');
    });






    Route::prefix('roles')->name('roles.')->group(function () {
        Route::get('/', 'RoleController@index')->name('index');
        Route::get('create', 'RoleController@create')->name('create');
        Route::post('create', 'RoleController@store');
        Route::get('edit/{role}', 'RoleController@edit')->name('edit');
        Route::post('edit/{role}', 'RoleController@update');
        Route::get('show/{role}', 'RoleController@show')->name('show');
    });

    Route::prefix('users')->name('users.')->group(function () {
        Route::get('/', 'UserController@index')->name('index');
        Route::get('create', 'UserController@create')->name('create');
        Route::post('create', 'UserController@store');
        Route::get('edit/{user}', 'UserController@edit')->name('edit');
        Route::post('edit/{user}', 'UserController@update');
        Route::get('show/{user}', 'UserController@show')->name('show');
        Route::post('delete/{user}', 'UserController@destroy')->name('destroy');
        Route::get('logs/{user}', 'UserController@logs')->name('logs');
        Route::get('fetch-rms', 'UserController@fetchRMs')->name('fetch-rms');
        Route::get('create-rms', 'UserController@createRMs')->name('create-rms');
        Route::post('submit-rms', 'UserController@SubmitRMs')->name('submit-rms');
        Route::post('reset-pass-rms', 'UserController@resetPasswordRMS')->name('reset-pass-rms');
        Route::post('reset-device', 'UserController@resetDeviceRMS')->name('reset-device');
        Route::post('action-on-device', 'UserController@actionDevice')->name('action-on-device');
    });

    Route::resource('/users/deleted', 'SoftDeletesController', [
        'only' => [
            'index', 'show', 'update', 'destroy',
        ],
    ]);

    Route::prefix('uploads')->name('uploads.')->group(function () {
        Route::get('/', 'UploadController@index')->name('index');
        Route::get('create', 'UploadController@create')->name('create');
        Route::post('create', 'UploadController@processUpload');

        Route::post('approve/{upload}', 'UploadController@approveUpload')->name('approve');
        Route::post('decline/{approve}', 'UploadController@declineUpload')->name('decline');
    });

    Route::prefix('branch')->name('branch.')->group(function () {
       Route::get('/', 'BranchController@index')->name('index');
//       Route::get('create', 'BranchController@create')->name('create');
    });
    Route::post('create', 'BranchController@store');

    Route::prefix('location')->name('location.')->group(function () {
        Route::get('/', 'LocationController@index')->name('index');
        Route::get('create', 'LocationController@create')->name('create');
        Route::post('create', 'LocationController@store');
    });

    Route::prefix('agent-transactions')->name('agent-transactions.')->group(function () {
        Route::get('balance-inquiry', 'AgentTransactionsController@fetchBalance')->name('balance-inquiry');
        Route::post('balance', 'AgentTransactionsController@balance');
        Route::get('cash-deposit', 'AgentTransactionsController@cashDeposit')->name('cash-deposit');
        Route::post('deposit', 'AgentTransactionsController@deposit');
        Route::get('cash-withdrawal', 'AgentTransactionsController@cashWithdrawal')->name('cash-withdrawal');
        Route::post('withdrawal', 'AgentTransactionsController@withdrawal');
    });
});

Route::get('console', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');
