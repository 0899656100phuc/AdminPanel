<?php
use App\Http\Controllers\Api\CityController;
use App\Http\Controllers\Api\RoomController;
use App\Models\Hotel;
use App\Http\Controllers\Api\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('user/profile',  [AuthController::class, 'show'])->middleware('auth:sanctum');
use App\Http\Controllers\Api\HotelController;
Route::get('hotels', [HotelController::class, 'index']);

//API route để đăng ký
Route::post('user/register', [AuthController::class, 'register']);
Route::post('/user/login', [AuthController::class, 'login']);

//search

Route::get('hotels/searchAddress', [CityController::class, 'searchAddress']);
Route::get('hotels/search', [HotelController::class, 'search']);
Route::get('hotels/{id}', [HotelController::class, 'getHotelById']);
Route::post('hotels/bookRoom', [RoomController::class, 'bookRoom']);
Route::post('hotels/payment', [RoomController::class, 'payment']);


