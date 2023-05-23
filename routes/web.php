<?php

use App\Http\Controllers\Admin\DasboardController;
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
    return view('welcome');
});
Route::get('dashboard', function () {
    return view('admin.dashboard');
});
Route::prefix('admin')->group(function () {
    Route::get('dashboard', [App\Http\Controllers\Admin\DasboardController::class,'index']);
});
//route
Route::get('hotel',[App\Http\Controllers\Admin\HotelController::class,'index']);
Route::get('type-room',[App\Http\Controllers\Admin\RoomTypeController::class,'index']);
Route::get('rooms',[App\Http\Controllers\Admin\RoomController::class,'index']);
Route::get('city',[App\Http\Controllers\Admin\CityController::class,'index']);

Route::get('create-hotel',[App\Http\Controllers\Admin\HotelController::class,'create']);
Route::get('/edit-hotel/{hotel_id}',[App\Http\Controllers\Admin\HotelController::class,'edithotel']);
Route::get('/edit-city/{city_id}',[App\Http\Controllers\Admin\CityController::class,'editcity']);

Route::get('create-room',[App\Http\Controllers\Admin\RoomController::class,'create']);
Route::get('create-type-room',[App\Http\Controllers\Admin\RoomTypeController::class,'create']);
Route::get('create-city',[App\Http\Controllers\Admin\CityController::class,'create']);


//
Route::post('create-hotel',[App\Http\Controllers\Admin\HotelController::class,'store']);
Route::post('create-city',[App\Http\Controllers\Admin\CityController::class,'store']);
Route::post('create-type-room',[App\Http\Controllers\Admin\RoomTypeController::class,'store']);
Route::post('create-room',[App\Http\Controllers\Admin\RoomController::class,'store']);
Route::get('/edit-room/{room_id}',[App\Http\Controllers\Admin\RoomController::class,'editRoom']);

Route::put('/update-hotel/{hotel_id}',[App\Http\Controllers\Admin\HotelController::class,'update']);
Route::post('/update-city/{city_id}',[App\Http\Controllers\Admin\CityController::class,'update']);
Route::put('/update-room/{room_id}',[App\Http\Controllers\Admin\RoomController::class,'update']);


Route::get('/delete-hotel/{hotel_id}',[App\Http\Controllers\Admin\HotelController::class,'destroy']);
Route::delete('/deleteimage/{hotel_id}',[App\Http\Controllers\Admin\HotelController::class,'deleteimage']);
Route::put('deleteservice/{service_id}',[App\Http\Controllers\Admin\HotelController::class,'deleteService']);
Route::put('deleteserviceRoom/{service_id}',[App\Http\Controllers\Admin\RoomController::class,'deleteService']);


Route::delete('/deleteimage/{id}',[App\Http\Controllers\Admin\RoomController::class,'deleteimage']);

