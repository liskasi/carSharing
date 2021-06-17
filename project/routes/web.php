<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\auth\LoginController;
use Laravel\Socialite\Facades\Socialite;
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
    // return view('main');
// });

Route::get('/', function ()
{
    $carsDB = DB::table('cars')->where('status','=','Approved')->get();
    return view ('welcome', ['carsDB' => $carsDB]);
});//->middleware(['auth'])->name('dashboard');


Route::get('homeguest', function ()
{
    $carsDB = DB::table('cars')->where('status','=','Approved')->get();
    return view ('homeguest', ['carsDB' => $carsDB]);
})->name('homeguest');

Route::get('lang/{lang}', ['as' => 'lang.switch', 'uses' => 'App\Http\Controllers\LanguageController@switchLang']);
//Route::get('lang/{lang}','LanguageController@switchLang')->name('lang.switch');
Route::get('/languageDemo', 'App\Http\Controllers\HomeController@languageDemo');

Route::get('home/{lang}', 'App\Http\Controllers\HomeController@languageDemo');

Auth::routes();

Route::resource('car', App\Http\Controllers\CarController::class);

Route::get('login/google',[App\Http\Controllers\Auth\LoginController::class,'redirectToGoogle'])->name('login.google');
Route::get('login/google/callback',[App\Http\Controllers\Auth\LoginController::class,'handleGoogleCallback']);

Route::get('login/facebook',[App\Http\Controllers\Auth\LoginController::class,'redirectToFacebook'])->name('login.facebook');
Route::get('login/facebook/callback',[App\Http\Controllers\Auth\LoginController::class,'handleFacebookCallback']);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/guestfilter', [App\Http\Controllers\CarController::class, 'update'])->name('car.update');

Route::get('admin', function()
{
	$carsDB = DB::table('cars')->get();
	return view ('home', ['carsDB' => $carsDB]);
});
Route::resource('viewuser', App\Http\Controllers\UserController::class);

Route::post('/admin', [App\Http\Controllers\CarController::class, 'status']);
Route::get('/viewusers', [App\Http\Controllers\CarController::class, 'viewusers'])->name('viewusers');
Route::get('/fav', [App\Http\Controllers\CarController::class, 'fav'])->name('fav');


Route::get('/mycar', function()
{
	$carsDB = DB::table('cars')->where('user_id', '=',auth()->user()->id)->get();
	return view ('pages.mycar', ['carsDB' => $carsDB]);
})->name('mycars');


Route::post('/mycar', [App\Http\Controllers\CarController::class, 'change'])->name('car.change');

Route::post('/car/comment', ['as' => 'comment.store', 'uses' => 'App\Http\Controllers\CommentController@store']);

Route::resource('/rentedcar', App\Http\Controllers\RentedCarController::class);
Route::post('/rentedcar', ['as' => 'rentedcar.store', 'uses' => 'App\Http\Controllers\RentedCarController@store']);
Route::post('/rentedcar/update', ['as' => 'rentedcar.update', 'uses' => 'App\Http\Controllers\RentedCarController@update']);

Route::get('/guestfilter', [App\Http\Controllers\CarController::class, 'guestfilter'])->name('guestfilter');
Route::post('/guestfilter', [App\Http\Controllers\CarController::class, 'guestfilter']);



Route::group(['middleware' => 'auth'], function () {
	Route::resource('user', 'App\Http\Controllers\UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'App\Http\Controllers\ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'App\Http\Controllers\ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']);
	Route::get('{page}', ['as' => 'page.index', 'uses' => 'App\Http\Controllers\PageController@index']);
	Route::put('car', ['as' => 'car.store', 'uses' => 'App\Http\Controllers\CarController@store']);
	Route::post('car', ['as' => 'car.filter', 'uses' => 'App\Http\Controllers\CarController@filter']);
	Route::put('car/update', ['as' => 'car.update', 'uses' => 'App\Http\Controllers\CarController@update']);
});


