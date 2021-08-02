<?php
Route::get('/', function (){
    return redirect('/admin/home');
});

Route::get('/home', function () {
    $users[] = Auth::user();
    $users[] = Auth::guard()->user();
    $users[] = Auth::guard('admin')->user();

    return view('admin.home');
})->name('Inicio');

/*====================================
=            Publications            =
====================================*/

Route::resource('publication', 'admin\PublicationController', [
    'names' => [
        'index' => 'Publicaciones'
    ]
]);

Route::get('getPublications', 'admin\PublicationController@getPublications')->name('getPublications');
Route::resource('publications', 'admin\PublicationController');


/*=====  End of Publications  ======*/



/*==================================
=            Categories            =
==================================*/

Route::resource('category', 'admin\CategoryController', [
    'names' => [
        'index' => 'Categorias'
    ]
]);

Route::get('getCategories', 'admin\CategoryController@getCategories')->name('getCategories');
Route::resource('categories', 'admin\CategoryController');

/*=====  End of Categories  ======*/

/*==================================
=            Customers Users            =
==================================*/

Route::resource('customer', 'admin\CustomerController', [
    'names' => [
        'index' => 'Usuarios'
    ]
]);

Route::get('getCustomers', 'admin\CustomerController@getCustomers')->name('getCustomers');
Route::get('getCustomerCoupons/{id}', 'admin\CustomerController@getCustomerCoupons')->name('getCustomerCoupons');
Route::resource('customers', 'admin\CustomerController');

Route::get('deleteCustomerCoupon/{id}', 'admin\CustomerController@deleteCustomerCoupon')->name('customerCoupon.destroy');

/*=====  End of Customers Users  ======*/

/*==================================
=            Devices             =
==================================*/

Route::resource('device', 'admin\DeviceController', [
    'names' => [
        'index' => 'Dispositivos'
    ]
]);

Route::get('getDevices', 'admin\DeviceController@getDevices')->name('getDevices');
Route::resource('devices', 'admin\DeviceController');

Route::post('device/validateMacUnique', 'admin\DeviceController@validateMacUnique')->name('validateMacUnique');

Route::get('device/messages/{id}', 'admin\DeviceController@messages')->name('deviceMessages');

Route::post('device/saveDeviceMessage', 'admin\DeviceController@saveDeviceMessage')->name('saveDeviceMessage');
Route::post('device/deleteDeviceMessage', 'admin\DeviceController@deleteDeviceMessage')->name('deleteDeviceMessage');

/*=====  End of Devices   ======*/
/*==================================


/*==================================
=            Categories            =
==================================*/

Route::resource('client', 'admin\ClientController', [
    'names' => [
        'index' => 'Clientes'
    ]
]);

Route::get('getClients', 'admin\ClientController@getClients')->name('getClients');
Route::get('getClientPublications/{id}', 'admin\ClientController@getClientPublications')->name('getClientPublications');
Route::resource('clients', 'admin\ClientController');

/*=====  End of Categories  ======*/


/*=============================================
=            Informacion de perfil            =
=============================================*/

Route::resource('infoProfile', 'admin\InfoProfileController', [

    'names' => [
        'index'=> 'infoProfile'
    ]

]);

Route::get('getInfoProfile', 'admin\InfoProfileController@getInfoProfile');
/*=====  End of Informacion de perfil  ======*/
