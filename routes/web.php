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
    Route::get('/change_storage', 'HomeController@change_storage')->name('change_storage');
    Route::post('/update_storage', 'HomeController@update_storage')->name('update_storage');

// просмотр накладных
    Route::get('/invoice/', 'InvoiceController@invoice_list')->name('invoice_list');
    Route::get('/invoice/{id?}', 'InvoiceController@detail')->name('invoice_detail');

// сотрудники
    Route::get('/worker/', 'WorkerController@worker_list')->name('worker_list');
    Route::get('/worker_detail/{id?}', 'WorkerController@worker_detail')->name('worker_detail');

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
    Route::post('/provider/fin', 'ProvidersController@fin')->name('fin_op_provider');

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
    Route::get('/products/{storage?}', 'ProductsController@index')->name('list_products');
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
    Route::get('/orders', 'OrderController@index')->name('orders_list');
    Route::get('/orders_all/{sort_date?}', 'OrderController@index_all')->name('orders_list_all');
    Route::get('/order/{id?}', 'OrderController@detail')->name('order_detail');
    Route::get('/order/new/{client?}', 'OrderController@new_order')->name('new_order');
    Route::post('/order/new/', 'OrderController@create_order')->name('create_order');
    Route::post('/order/update/', 'OrderController@update_order')->name('update_order');
    Route::post('/order/change_status/', 'OrderController@change_status')->name('change_status');

//счета
    Route::get('/bill', 'BillsController@index')->name('bills');
    Route::get('/bill_detail/{id?}/{filter?}', 'BillsController@detail')->name('bill_detail');
    Route::post('/bill', 'BillsController@move_cash')->name('cash_operation_bill');

//финансовые операции
    Route::post('/cash', 'CashController@cash_operation_client')->name('cash_operation_client');

//Расходы
    Route::get('/costs', 'CostsController@index')->name('costs');
    Route::get('/create_spends', 'CostsController@create_spends')->name('create_spends');
    Route::post('/costs', 'CostsController@new_cost')->name('new_cost');
    Route::post('/sub_cat_spends', 'CostsController@sub_cat_spends')->name('sub_cat_spends');
    Route::post('/spends/count_max', 'CostsController@count_max')->name('count_max_bill_spends');

//Смена
    Route::get('/shift', 'ShiftController@index')->name('shift');
    Route::post('/shift/end', 'ShiftController@endShift')->name('end_shift');
    Route::post('/shift/new', 'ShiftController@newShift')->name('new_shift');

// опт
    Route::get('/opt_clients', 'WholesaleController@opt_clients')->name('opt_clients_list');
    Route::get('/opt_clients_detail/{id?}', 'WholesaleController@opt_clients_detail')->name('opt_client_detail');
    Route::post('/create_opt_client', 'WholesaleController@create_opt_client')->name('create_opt_client');

// адреса и контакты
    Route::post('/add_address', 'WholesaleController@add_address')->name('add_address');
    Route::post('/add_contact', 'WholesaleController@add_contact')->name('add_contact');


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

