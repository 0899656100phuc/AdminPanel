<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Citys;
use App\Models\Hotel;
use App\Models\Room;
use App\Http\Resources\Hotel as HotelResources;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HotelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $hotel = Hotel::get();
        $arr = [
            'status' => 200,
            'message' => "Danh sách khách sạn",
            'data' => HotelResources::collection($hotel)
        ];
        return response()->json($arr, 200);
    }
    public function getHotelById(Request $request, $id)
    {

        $hotels = Hotel::with('services', 'rooms', 'images')->find($id);
        $hotels->image = url('images/hotel/' . $hotels->image);

        foreach ($hotels->images as $image) {
            $image->image = url('images/hotel/' . $image->image);
        }
        foreach ($hotels->rooms as $room) {
            $room->type_room = $room->typeRoom;
            $room->images_room = $room->images;
            $room->service_room = $room->services;
            $images = $room->images;
            foreach ($images as $image) {
                $image->image = url('images/room/' . $image->image);
            }
            unset($room->typeRoom);
            unset($room->images);
            unset($room->services);
        }


        if ($hotels) {
            return response()->json([
                'success' => true,
                'message' => "Danh sách khách sạn",
                'hotel' => $hotels
            ], 200);
        } else {
            return response()->json(['success' => false, 'message' => 'Hotel not found.'], 404);
        }
    }



    public function search(Request $request)
    {
        $address = $request->get('address');
        $numGuests = $request->get('numberPeople');
        $numRooms = $request->get('numberRooms');
        $checkInDate = $request->get('checkin_date');
        $checkOutDate = $request->get('checkout_date');


        $hotels = Hotel::where('address', 'like', "%$address%") //tìm kiếm theo địa điểm khách sạn
            ->whereHas('rooms', function ($query) use ($numGuests) { // tìm kiếm số lượng khách thông qua relationship
                $query->whereHas('typeRoom', function ($query) use ($numGuests) {
                    $query->where('number_of_people', '>=', $numGuests);
                });
            })
            ->whereHas('rooms', function ($query) use ($numRooms) { //tìm kiếm số lượng phòng 
                $query->havingRaw('COUNT(*) >= ?', [$numRooms]);
            })
            ->with([
                'rooms' => function ($query) use ($numGuests, $checkInDate, $checkOutDate) {
                    $query->with([
                        'typeRoom' => function ($query) {
                            $query->orderBy('price', 'asc')->first();
                        }
                    ])
                        ->where('number_of_people', '>=', $numGuests)
                        ->whereDoesntHave('bookingDetail', function ($query) use ($checkInDate, $checkOutDate) {
                            $query->where(function ($q) use ($checkInDate, $checkOutDate) {
                                $q->whereBetween('checkin', [$checkInDate, $checkOutDate])
                                    ->orWhereBetween('checkout', [$checkInDate, $checkOutDate])
                                    ->orWhere(function ($q2) use ($checkInDate, $checkOutDate) {
                                        $q2->where('checkin', '<=', $checkInDate)
                                            ->where('checkout', '>=', $checkOutDate);
                                    });
                            });
                        });
                }
            ])
            ->with([
                'rooms' => function ($query) {
                    $query->where('status', '!=', 'Đã đặt')->with('typeRoom');
                }
            ])
            ->has('rooms', '>', 0)
            ->get();
        foreach ($hotels as $hotel) {
            $lowestPrice = null;
            foreach ($hotel->rooms as $room) {
                if (!$lowestPrice || $room->typeRoom->price < $lowestPrice) {
                    $lowestPrice = $room->typeRoom->price;
                }
            }
            $hotel->lowestPrice = $lowestPrice;
            $hotel->image = url('images/hotel/' . $hotel->image);
        }
        $numberOfHotels = $hotels->count();
        return response()->json([
            'message' => 'success',
            'data' => $hotels,
            'numberOfHotels' => $numberOfHotels
        ], 200);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
