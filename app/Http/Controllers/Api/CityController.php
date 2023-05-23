<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\Hotel as HotelResources;
use App\Http\Resources\Citys as CityResources;
use App\Models\Citys;
class CityController extends Controller
{
    public function searchAddress(Request $request)
    {
        $address = $request->get('address');
        //.$citysHotel = Citys::where('name', 'like', "%$address%")->with('hotels')->get();
        $citys = Citys::where('name', 'like', "%$address%") ->withCount('hotels')->get();
        foreach ($citys as $city) {
            $city->image = url('images/city/' . $city->image);
        }
        /* $totalHotels = 0;
    
    foreach ($citys as $city) {
        $totalHotels += count($city->hotels);
    } */
     
        return response()->json([
            'message' => 'success',
            'data' => $citys,
        ], 200);
    }
}
