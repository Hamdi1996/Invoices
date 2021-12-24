<?php

use App\Http\Controllers\InvoicesController;
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

Route::get('/', function () {
    return view('auth.login');
});

//Disabled Register for all users
Auth::routes(['register'=>false]);

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('invoices','InvoicesController');

Route::resource('InvoiceAttachments','InvoicesAttachmentController');

Route::get('/section/{id}','InvoicesController@getproducts');

Route::get('/InvoiceDetails/{id}','InvoicesDetailsController@edit');

Route::get('/download/{invoice_number}/{file_name}','InvoicesDetailsController@download');

Route::get('/View_file/{invoice_number}/{file_name}','InvoicesDetailsController@file_open');

Route::post('/delete_file','InvoicesDetailsController@destroy')->name('delete_file');

Route::resource('sections','SectionController');

Route::resource('products','ProductController');

Route::get('edit_invoice/{id}','InvoicesController@edit');

Route::get('Status_show/{id}','InvoicesController@show')->name('Status_show');

Route::post('Status_Update/{id}','InvoicesController@Status_Update')->name('Status_Update');

Route::resource('Archive','ArchiveController');

Route::get('Invoice_Paid','InvoicesController@Invoice_Paid')->name('Invoice_Paid');

Route::get('Invoice_UnPaid','InvoicesController@Invoice_UnPaid')->name('Invoice_UnPaid');

Route::get('Invoice_Partial','InvoicesController@Invoice_Partial')->name('Invoice_Partial');

Route::get('Print_invoice/{id}','InvoicesController@Print_invoice');

Route::get('export_invoices', 'InvoicesController@export');


Route::group(['middleware' => ['auth']], function() {
    Route::resource('roles','RoleController');
    Route::resource('users','UserController');
    });


Route::get('invoices_reporter','ReportController@index');

Route::post('Search_invoices','ReportController@Search_invoices');

Route::get('customers_report','CustomerController@index');

Route::post('Search_customers','CustomerController@Search_customers');

Route::get('MarkAsRead_all','InvoicesController@MarkAsRead_all')->name('MarkAsRead_all');

Route::get('unreadNotifications_count', 'InvoicesController@unreadNotifications_count')->name('unreadNotifications_count');

Route::get('unreadNotifications', 'InvoicesController@unreadNotifications')->name('unreadNotifications');


Route::get('/{page}', 'AdminController@index');
