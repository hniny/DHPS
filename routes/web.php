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

// Route::get('/', function () {
//     return redirect(app()->getLocale());
// });

// Route::group(['prefix' => 'lang'], function ($lang) {
//     Route::get('/', function () {
//         App::setLocale($lang);
//         return view('welcome');
//     });
// });

   
// Route::group(['prefix' => '{lang}','middleware' => ['lang']], function() {
//     Route::get('/', function () {
//         return view('welcome');
//     })->name('/');

//     Auth::routes();
//     Route::get('/home', 'HomeController@index')->name('home');

// });
Route::get('/admin', function () {
  return redirect()->route('login');
})->name('/admin');
Route::get('/', function () {
  return redirect()->route('orders.index');
})->name('/');

Route::get('access-denied', function () {
  return view('access_denied');
})->name('access-denied');

// Customer and Team Member and Warehouse Manager Registeration
Route::namespace('Auth')->group(function () {
  Route::get('/customer_register', 'CustomerLoginController@register')->name('customer_register'); 
  Route::post('/customer-register', 'CustomerLoginController@customerRegister')->name('customer-register'); 
  Route::get('/customer_login', 'CustomerLoginController@login')->name('customer_login'); 
  Route::post('/customer-login', 'CustomerLoginController@customerLogIn')->name('customer-login'); 
  Route::get('/city-townships', 'CustomerLoginController@cityTownship');
  Route::get('/city-zones', 'CustomerLoginController@cityZone');
  //heey
  // Route::get('/city-zones', 'TeamMemberLoginController@cityZone');

  Route::get('/teammember', 'TeamMemberLoginController@login')->name('teamMember_login');
  Route::post('/teammember-login', 'TeamMemberLoginController@teamMemberLogIn')->name('teamMember-login');

  Route::get('/teammember_register', 'TeamMemberLoginController@register')->name('teamMember_register');
  Route::post('/teammember-register', 'TeamMemberLoginController@teamMemberRegister')->name('teamMember-register');

  Route::get('/warehouse_register', 'WarehouseLoginController@register')->name('warehouse_register'); 
  Route::post('/warehouse-register', 'WarehouseLoginController@warehouseRegister')->name('warehouse-register'); 
  Route::get('/warehouse_login', 'WarehouseLoginController@login')->name('warehouse_login'); 
  Route::post('/warehouse-login', 'WarehouseLoginController@warehouseLogIn')->name('warehouse-login'); 
});

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');


// Auth
Route::group(['middleware' => ['auth']], function() {
  Route::resources([
    'roles' => 'RoleController',
    'users' => 'UserController',
    'products' => 'ProductController',
    'customers' => 'CustomerController',
    'customer-orders' => 'CustomerOrderController',
    'credit-returns' => 'CreditReturnController',
    'teammembers' => 'TeamMemberController',
    'consigments' => 'ConsigmentController',
    'cities' => 'CityController',
    'zones' => 'ZoneController',
    'townships' => 'TownShipController',
    'positions' => 'PositionController',
    'departments' => 'DepartmentController',
  ]);
  
  Route::get('/payment_terms', 'CustomerController@paymentTerm');
    Route::post('/assignCustomerToTeamMember', 'CustomerController@assignCustomerToTeamMember');
    Route::get('/customerstore/{customer}', 'CustomerController@customerStore');
    Route::get('/warehouse/{customerOrder}', 'CustomerOrderController@warehouse');
    Route::get('/delivery/{customerOrder}', 'CustomerOrderController@delivery');
    Route::post('/uploadInvoiceCustomerOrder', 'CustomerOrderController@uploadInvoiceCustomerOrder');
    Route::post('/deliverCustomerOrder', 'CustomerOrderController@deliverCustomerOrder');
    Route::get('/getInvoiceList','CustomerOrderController@getInvoiceList');
    Route::post('/deleteContactPerson','TeamMemberController@deleteContactPerson');
    Route::post('/deleteOrderItem','CustomerOrderController@deleteOrderItem');
    Route::get('/getCustomer', 'ConsigmentController@getCustomer');
    Route::get('/change-password', 'ChangePasswordController@index')->name('changePassword');
    Route::post('/change-password', 'ChangePasswordController@store')->name('change.password');
    Route::get('/credential','UserController@credential');
    Route::get('/warehouse','CustomerOrderController@warehouseIndex')->name('warehouse');

    //Report PDF by yzn
    Route::get('/{id}/downloadTM','TeamMemberController@downloadlist');
    Route::get('/dailyOrder','CustomerOrderController@dailyOrder');
    Route::get('/monthlyOrder','CustomerOrderController@monthlyOrder');

    Route::get('weeklyReport', 'CustomerOrderController@weeklyExport')->name('weeklyReport');

    //customer Report
    Route::get('customerWeekly', 'CustomerController@customerWeekly')->name('customerWeekly');
    Route::post('customerWeekly', 'CustomerController@customerWeekly')->name('customerWeekly');
    Route::get('customerMonthly', 'CustomerController@customerMonthly')->name('customerMonthly');
    Route::post('customerMonthly', 'CustomerController@customerMonthly')->name('customerMonthly');
    Route::get('customerYearly', 'CustomerController@customerYearly')->name('customerYearly');
    Route::post('customerYearly', 'CustomerController@customerYearly')->name('customerYearly');

  //member Report
  Route::get('teamWeekly', 'TeamMemberController@teamWeekly')->name('teamWeekly');
  Route::post('teamWeekly', 'TeamMemberController@teamWeekly')->name('teamWeekly');
  Route::get('teamMonthly', 'TeamMemberController@teamMonthly')->name('teamMonthly');
  Route::post('teamMonthly', 'TeamMemberController@teamMonthly')->name('teamMonthly');
  Route::get('teamYearly', 'TeamMemberController@teamYearly')->name('teamYearly');
  Route::post('teamYearly', 'TeamMemberController@teamYearly')->name('teamYearly');

  //View Page
  Route::get('importExportView', 'MyController@importExportView');
  Route::get('export', 'MyController@export')->name('export');
  Route::post('import', 'MyController@import')->name('import');
  Route::get('import', 'MyController@import')->name('import');
    
});

// Customer Auth
Route::group(['middleware' => ['customerauth']], function () {
  Route::resources([
    'orders' => 'OrderController'
  ]);
  Route::get('/invoiceDownload', 'OrderController@invoiceDownload')->name('invdownload');
});

// Team Member
Route::group(['middleware' => 'teamMemberauth'], function () {
  Route::resources([
    'teammember_orders' => 'TeamMemberOrderController'
  ]);
});

//for kpay
Route::get('kpay','KpayController@kpay');
Route::post('billPayment','KpayController@preCreate');
Route::match(array('GET','POST'),'/kbzCallBack','KpayController@kpayPaymentProcess');
//for pwa kpay
Route::get('kbzPayment','KpayController@pwaKpay');
Route::match(array('GET','POST'),'/success','KpayController@pwaPaymentProcess');
