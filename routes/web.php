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

Route::get('/', function () {
    $usercount = \App\User::count();
    return view('welcome', [
        'counts' => $usercount
    ]);
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::resource('/password', 'PasswordController');
Route::resource('/profile', 'ProfileController');
Route::resource('/setting', 'SettingController');
Route::resource('/sms', 'SmsController');
Route::get('/smstesting', 'SmsController@test');
Route::resource('/room', 'RoomsController');
Route::resource('/customer', 'CustomerController');
Route::get('/customer/reset/{id}', 'CustomerController@reset');
Route::resource('/contact', 'ContactController');
Route::resource('/event', 'EventController');
Route::resource('/point', 'PointController');
Route::resource('/history_sms', 'HistorySMS');
Route::resource('/sent_sms', 'SentSMSController');
Route::resource('/discount', 'DiscountController');
Route::resource('/booking', 'BookingController');
Route::resource('/manage_booking', 'ManageBookingController');
Route::get('/manage_booking/booking/{id}', 'ManageBookingController@booking');
Route::get('/manage_booking/payment/{id}', 'ManageBookingController@payment');
Route::post('/manage_booking/payment/pay/{id}', 'ManageBookingController@pay');
Route::resource('/inbox', 'InboxController');
Route::post('/inbox/create', 'InboxController@create');
Route::resource('/bank', 'BankController');
Route::resource('/sent_email', 'SentEmailController');
Route::resource('/history_email', 'HistoryEmail');
Route::resource('/manage_contract', 'ManageContractController');
Route::get('/manage_contract/files/{id}', 'ManageContractController@files');
Route::get('/manage_contract/imanges/{id}', 'ManageContractController@imanges');
Route::get('/manage_contract/invoice/{id}', 'ManageContractController@invoice');
Route::get('/manage_contract/recivce/{id}', 'ManageContractController@recivce');
Route::get('/manage_contract/services/{id}', 'ManageContractController@services');
Route::post('/manage_contract/service/delete', 'ManageContractController@deleteservices');
Route::get('/manage_contract/familys/{id}', 'ManageContractController@familys');
Route::post('/manage_contract/family', 'ManageContractController@family');
Route::post('/manage_contract/family/delete', 'ManageContractController@deletefamily');
Route::post('/manage_contract/uploads', 'ManageContractController@uploads');
Route::post('/manage_contract/service', 'ManageContractController@service');
Route::get('/manage_contract/pay/{id}', 'ManageContractController@pay');
Route::post('/manage_contract/payment', 'ManageContractController@payment');
Route::get('/manage_contract/move/{id}', 'ManageContractController@move');
Route::post('/manage_contract/moved/{id}', 'ManageContractController@moved');
Route::resource('/contract', 'ContractController');
Route::get('/manage_contract/cancel/{id}', 'ManageContractController@cancel');
Route::post('/manage_contract/confirmcancel', 'ManageContractController@confirmcancel');
Route::post('/manage_contract/canceled', 'ManageContractController@canceled');
Route::get('/manage_contract/invoices/{id}', 'ManageContractController@invoices');
Route::resource('/invoice', 'InvoiceController');
Route::get('/invoice/view/{id}', 'InvoiceController@view');
Route::get('/invoice/print/{id}', 'InvoiceController@printer');
Route::get('/invoice/sms/{id}', 'InvoiceController@sms');
Route::get('/invoice/email/{id}', 'InvoiceController@email');
Route::resource('/manage_invoice', 'InvoiceManageController');
