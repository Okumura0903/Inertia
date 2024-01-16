<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\ListingController;
use App\Http\Controllers\ListingOfferController;
use App\Http\Controllers\UserAccountController;
use App\Http\Controllers\RealtorListingController;
use App\Http\Controllers\RealtorListingImageController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/',[IndexController::class,'index']);
Route::get('/hello',[IndexController::class,'show'])
  ->middleware('auth');

Route::resource('listing',ListingController::class)
->only(['index','show']);

Route::resource('listing.offer',ListingOfferController::class)
  ->middleware('auth')
  ->only(['store']);

Route::get('login',[AuthController::class,'create'])
  ->name('login');
  Route::post('login',[AuthController::class,'store'])
  ->name('login.store');
  Route::delete('logout',[AuthController::class,'destroy'])
  ->name('logout');

Route::resource('user-account',UserAccountController::class)
  ->only(['create','store']);

Route::prefix('realtor')
  ->name('realtor.')
  ->middleware('auth')
  ->group(function(){
    Route::name('listing.restore')
      ->put(
        'listing/{listing}/restore',
        [RealtorListingController::class,'restore']
      )->withTrashed();
    Route::resource('listing',RealtorListingController::class)
//      ->only(['index','destroy','edit','update','create','store'])
      ->withTrashed();

    Route::resource('listing.image',RealtorListingImageController::class)
    ->only(['create','store','destroy']);
  });



