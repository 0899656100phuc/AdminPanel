<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Hotel;
use App\Models\Room;
use App\Models\Bookings;
use App\Models\BookingDetail;
use App\Models\People;
use App\Models\TypeRoom;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function getUserBookings($userId)
    {
        $customer = Bookings::where('user_id', $userId);

        $bookings = $customer->get();

        foreach ($bookings as $booking) {
            // Access booking properties
            $id = $booking->id;

            $detail = BookingDetail::where('booking_id', $id)->orderby('id', 'asc')->get();
            $booking->booking_details = $detail;
            foreach ($detail as $value) {
                $roomNew = Room::where('id', $value->room_id)->first();
                $Hotel = Hotel::where('id', $roomNew->hotel_id)->first();
                $typeRoom = TypeRoom::where('id', $roomNew->type_room_id)->first();
                $peoples = People::where('id_booking', $id)->first();

                $value->hotel = $Hotel;
                $value->rooms = $roomNew;
                $value->typeRoom = $typeRoom;
                $value->people = $peoples;

                //$value->typeRoom = $roomNew->typeRoom;
            }
        }


        /*  echo json_encode($id);
        exit; */
        return response()->json($bookings);
    }
    public function getHotelRoomBooking($id)
    {
        $booking = Bookings::where('id', $id)->first();
        $detail = BookingDetail::where('booking_id', $id)->first();
        echo json_encode($detail);
        exit;
        $hotel = Hotel::findOrFail();
        $room = Room::findOrFail();
        $bookings = $room->bookingDetailRoom()->with('bookings')->get();

        $data = [
            'hotel' => $hotel,
            'room' => $room,
            'bookings' => $bookings
        ];

        return response()->json(['data' => $data]);
    }
}