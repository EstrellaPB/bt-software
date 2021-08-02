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

/**********************************
 ***********  Index **********
 **********************************/
Route::get('/', 'IndexController@index')->name('Inicio');

/**********************************
 **********  Publications *********
 **********************************/
Route::post('/clickPublication', 'PublicationController@click')->name('click');
Route::get('/search', 'PublicationController@searchPublications');
Route::post('/publications/addCoupon', 'PublicationController@addCoupon');
Route::resource('publications', 'PublicationController', [
    'names' => [
        'index' => 'Publicaciones',
        'show' => 'PublicacionesShow'
    ]
]);

/**********************************
 ***********  Categories **********
 **********************************/
Route::resource('categories', 'CategoriesController', [
    'names' => [
        'index' => 'Categorias',
        'show' => 'CategoriasShow'
    ]
]);

/*********************************
 ************  Coupons ***********
 *********************************/
Route::get('/promotions',
    function () { return view('index', [
        "publications" => \publicity\Publication::where('is_coupon', true)->simplePaginate(6)
]); })->name('Promociones');
Route::resource('/coupons', 'CouponsController');

/*********************************
 ***********   Devices  **********
 *********************************/
Route::get('/getMessages', 'DeviceController@getMessage')->middleware('deviceAuth');
Route::get('/test', function (){
    return response()->json(["test" => "OK"])->header('Content-Length', 200);
});
//Route::get('/getMessages', 'DeviceController@getMessage');

/**********************************
 ***********   Customer  **********
 **********************************/
Route::group(['prefix' => 'customer'], function () {
  Route::get('/login', 'CustomerAuth\LoginController@showLoginForm')->name('login');
  Route::post('/login', 'CustomerAuth\LoginController@login')->name('log');
  Route::get('/logout', 'CustomerAuth\LoginController@logout')->name('logout');

  Route::get('/register', 'CustomerAuth\RegisterController@showRegistrationForm');
  Route::post('/register', 'CustomerAuth\RegisterController@register')->name('customerRegister');

  Route::post('/password/email', 'CustomerAuth\ForgotPasswordController@sendResetLinkEmail')->name('password.request');
  Route::post('/password/reset', 'CustomerAuth\ResetPasswordController@reset')->name('password.email');
  Route::get('/password/reset', 'CustomerAuth\ForgotPasswordController@showLinkRequestForm')->name('password.reset');
  Route::get('/password/reset/{token}', 'CustomerAuth\ResetPasswordController@showResetForm');
});

/*********************************
 ************   Admin  ***********
 *********************************/
Route::group(['prefix' => 'admin'], function () {
  Route::get('/login', 'AdminAuth\LoginController@showLoginForm')->name('login');
  Route::post('/login', 'AdminAuth\LoginController@login')->name('adminLogin');
  Route::get('/logout', 'AdminAuth\LoginController@logout')->name('logout');

  Route::get('/register', 'AdminAuth\RegisterController@showRegistrationForm')->name('register');
  Route::post('/register', 'AdminAuth\RegisterController@register');

  Route::post('/password/email', 'AdminAuth\ForgotPasswordController@sendResetLinkEmail')->name('password.request');
  Route::post('/password/reset', 'AdminAuth\ResetPasswordController@reset')->name('password.email');
  Route::get('/password/reset', 'AdminAuth\ForgotPasswordController@showLinkRequestForm')->name('password.reset');
  Route::get('/password/reset/{token}', 'AdminAuth\ResetPasswordController@showResetForm');
  
});
