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

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
     
});
//Route::get('/order/index','OrderController@index')->name('order/index');
// Route::group(['prefix' => 'admin','as' => 'voyager.', 'middleware' => 'admin.user'], function()
// {
//     Route::get('order/index','OrderController@index')->name('order/index');
  
// });

try {
    $pages = \TCG\Voyager\Models\Page::all();
    foreach ($pages as $page) {
        Route::get($page->slug, 'TestController@show');
    }
} catch (\Exception $exception) {
    // do nothing
}
try {
    $posts = \TCG\Voyager\Models\Post::all();
    foreach ($posts as $post) {

        Route::get($post->slug, 'TestController@showPost');
    }

} catch (\Exception $exception) {
    // do nothing
}

Route::group(['prefix' => LaravelLocalization::setLocale(),  'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']], function() {
	Route::group(['before'=>'auth'], function(){
     Route::get('logout', 'LoginController@logout');
 });
    Route::get('/','HomeController@home')->name('home');
    Route::get('/service','HomeController@service')->name('service');
    Route::get('/platform','HomeController@platform')->name('platform');
    Route::get('/design','HomeController@design')->name('design');
    Route::get('/about','HomeController@about')->name('about');
    Route::get('/contact','HomeController@contact')->name('contact');
    Route::get('/lookbook','HomeController@lookbook')->name('lookbook');
    Route::get('/makeOwn','HomeController@makeOwn')->name('makeOwn');
    Route::get('/shopping_cart','HomeController@shopping_cart')->name('shopping_cart');
    Route::get('/user_profile','HomeController@user_profile')->name('user_profile');
    Route::post('/findOwn', 'HomeController@findOwn')->name('findOwn');
    Route::post('/getLensColor', 'HomeController@getLensColor')->name('getLensColor');
    Route::post('/getFramesColor', 'HomeController@getFramesColor')->name('getFramesColor');
    Route::post('/getTemplesColor', 'HomeController@getTemplesColor')->name('getTemplesColor'); 
    Route::get('/find_out_product', 'HomeController@find_out_product')->name('find_out_product');
    Route::post('/addtocart', 'HomeController@addtocart')->name('addtocart');
    Route::post('/submitOrder', 'HomeController@submitOrder')->name('submitOrder');
    Route::post('/clearAllItem', 'HomeController@clearAllItem')->name('clearAllItem');
    Route::post('/addEyeCase', 'HomeController@addEyeCase')->name('addEyeCase');
    Route::post('/updateProfile', 'HomeController@updateProfile')->name('updateProfile');
    Route::post('/updateOrder', 'HomeController@updateOrder')->name('updateOrder');
    Route::get('/order', 'HomeController@order')->name('order');
    Route::get('/home', 'HomeController@home')->name('home');
    Route::get('/blog/view/{id}', 'BlogController@home');
    Route::post('/asking', 'HomeController@asking')->name('asking');
    Route::post('/plan_asking', 'HomeController@plan_asking')->name('plan_asking');
    Route::get('login', 'LoginController@show');
    Route::post('login', 'LoginController@login')->name('login');
    Route::post('client_register', 'LoginController@client_register');
    Route::post('staff_register', 'LoginController@staff_register');

});






//Route::get('sister/index', 'FindSisterController@index')->name('sister_index');
