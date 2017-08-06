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
Route::get('/reg', 'HomeController@reg')->name('reg');


Route::group(['middleware' => 'authcheck'], function () {

    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('/logout', 'HomeController@logout')->name('logout');

// просмотр накладных
    Route::get('/invoice/', 'InvoiceController@invoice_list')->name('invoice_list');
    Route::get('/invoice/{id?}', 'InvoiceController@detail')->name('invoice_detail');

// добавление товара
    Route::post('/invoice_create', 'InvoiceController@create')->name('invoice_create');
    Route::get('/invoice_edit/{id}', 'InvoiceController@edit')->name('invoice_edit');
    Route::post('/invoice_add_item', 'InvoiceController@add_item')->name('add_item');
    Route::post('/invoice_complete', 'InvoiceController@complete')->name('invoice_complete');

// перемещение товара
    Route::post('/move_product', 'ProductsController@move_product')->name('move_product');
    Route::post('/move_product_create', 'ProductsController@move_product_create')->name('move_product_create');
    Route::get('/move_products_list', 'ProductsController@move_products_list')->name('move_products_list');
    Route::get('/move_products_detail/{id?}', 'ProductsController@move_products_detail')->name('move_products_detail');
    Route::get('/income_move_product', 'ProductsController@income_move_product')->name('income_move_product');
    Route::get('/income_move_detail/{id?}', 'ProductsController@income_move_detail')->name('income_move_detail');
    Route::post('/income_move_complete', 'ProductsController@income_move_complete')->name('income_move_complete');

//Поставщики
    Route::get('/provider/', 'ProvidersController@index')->name('list_providers');
    Route::get('/provider/{id?}', 'ProvidersController@detail')->name('detail_provider');
    Route::post('/provider/add', 'ProvidersController@add')->name('add_provider');

//клиенты
    Route::get('/clients', 'ClientsController@index')->name('clients');
    Route::get('/client/{id?}', 'ClientsController@detail')->name('detail_view');
    Route::post('/client/new', 'ClientsController@create')->name('create_client');
    Route::post('/client/fin_operation', 'ClientsController@fin_operation')->name('fin_operation');
    Route::get('/clients/promise_client', 'ClientsController@promise_client')->name('promise_client');

//поиск по имени и номеру телефона
    Route::post('/search', 'ClientsController@search')->name('search');
    Route::post('/home_search', 'ClientsController@home_search')->name('home_search');
    Route::get('/home_search', 'ClientsController@index')->name('home_search');
    Route::any('/search_json/{query}', 'ClientsController@json')->name('client_json');

//продажи
    Route::get('/sell/{id?}', 'SellController@index')->name('sell');
    Route::post('/sell', 'SellController@result_table')->name('result_table');
    Route::post('/sell_delete_product', 'SellController@delete_product')->name('delete_product');
    Route::post('/complete', 'SellController@complete')->name('complete');
    Route::get('/sells', 'SellController@sells_list')->name('sells_list');
    Route::get('/sell_view/{id?}', 'SellController@sell_detail')->name('sell_detail');
    Route::post('/sell/add_item', 'SellController@add_item')->name('add_item_sell');

//отчет
    Route::get('/full_report', 'ReportController@index')->name('full_report');

//продукты
    Route::get('/products', 'ProductsController@index')->name('list_products');
    Route::post('/products', 'ProductsController@index')->name('list_products');
    Route::get('/good/{id?}', 'GoodController@detail_product')->name('detail_products');
    Route::post('/good/update', 'GoodController@update')->name('update_good');
    Route::post('/good/sub_cat', 'GoodController@sub_cat')->name('sub_cat_good');
    Route::post('/promotion/new', 'PromotionController@new_promotion')->name('new_promotion');

// список наименований
    Route::get('/list_good', 'GoodController@list_goods')->name('list_goods');

//установка цен на продукты
    Route::post('/set_cost', 'SetCostController@set_cost')->name('set_cost');
    Route::post('/set_cost_complete', 'SetCostController@set_cost_complete')->name('set_cost_complete');

//API поиска
    Route::get('/search/product/{query?}', 'APIController@product')->name('product_search');
    Route::get('/search/good/{query?}', 'APIController@good')->name('good_search');


//заказы
    Route::get('/orders', 'OrderController@index')->name('order');
    Route::get('/order/{id?}', 'OrderController@detail')->name('order_detail');
    Route::get('/order/new/{client?}', 'OrderController@new_order')->name('new_order');
    Route::post('/order/new/', 'OrderController@create_order')->name('create_order');

//счета
    Route::get('/bill', 'BillsController@index')->name('bills');
    Route::post('/bill', 'BillsController@move_cash')->name('cash_operation_bill');

//финансовые операции
    Route::post('/cash', 'CashController@cash_operation_client')->name('cash_operation_client');

//Расходы
    Route::get('/costs', 'CostsController@index')->name('costs');
    Route::post('/costs', 'CostsController@new_cost')->name('new_cost');
    Route::post('/sub_cat', 'CostsController@sub_cat')->name('sub_cat');

//Смена
    Route::get('/shift', 'ShiftController@index')->name('shift');
    Route::post('/shift/end', 'ShiftController@endShift')->name('end_shift');
    Route::post('/shift/new', 'ShiftController@newShift')->name('new_shift');

// роуты для теста
    Route::get('/test', 'TestController@index')->name('test');
    Route::post('/test', 'TestController@add')->name('test');

    Route::get('/vue', 'VueController@index');
    Route::post('/vue', 'VueController@storage')->name('vuetest');


    Route::get('crud', 'CRUDController@index');
    Route::post('crud', 'CRUDController@add');
    Route::get('crud/view', 'CRUDController@view');
    Route::post('crud/update', 'CRUDController@update');
    Route::post('crud/delete', 'CRUDController@delete');
    Route::post('crud/add', 'CRUDController@add');

});

