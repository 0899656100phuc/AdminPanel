<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Bookings;
use App\Models\Payment;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\BookingDetail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class RoomController extends Controller
{
    public function bookRoom(Request $request)
    {
        // Lấy thông tin phòng từ request
        $roomId = $request->get('room_id');
        $startDate = $request->get('start_date');
        $endDate = $request->get('end_date');
        $totalPrice = $request->get('total_price');
        $user_id = $request->input('user_id');
        // Kiểm tra xem phòng có sẵn không
        $room = Room::find($roomId);
        if (!$room) {
            return response()->json(['message' => 'Phòng không tồn tại'], 404);
        }
    
        // Kiểm tra trạng thái của phòng
        if ($room->status=='Còn trống') {
            // Nếu phòng đang trống, tạo đặt phòng mới và cập nhật trạng thái phòng
            $booking = Bookings::create([
                'start_date' => $startDate,
                'end_date' => $endDate,
                'total_price' => $totalPrice, // Thay bằng giá thực tế
                'status' => 'Chưa thanh toán', // Thay bằng trạng thái thực tế
                'user_id' => $user_id 
            ]);

            $bookingDetail = BookingDetail::create([
                'room_id' => $roomId,
                'booking_id' => $booking->id,
            ]);
            $room->status = 'Đã đặt';
            $room->save();
    
            // Trả về thông tin phòng đã đặt
            return response()->json([
                'message' => 'Đặt phòng thành công',
                'booking' => $booking,
                'room' => $room,
            ], 200);
        } else {
            // Nếu phòng đang được đặt, trả về thông báo lỗi
            return response()->json(['message' => 'Phòng đã được đặt'], 400);
        }
    }

   

    public function payment(Request $request)
    {
        // Validate the request data
        $validated = $request->validate([
            'booking_id' => 'required|exists:bookings,id',
            'payment_method' => 'required|string',
            'payment_amount' => 'required|numeric',
            //'payment_date' => 'required|date',
        ]);
        $paymentStatusCode = $request->input('vnp_ResponseCode');
        // Retrieve the booking
        $booking = Bookings::findOrFail($validated['booking_id']);
        /* if ($booking->total_price != $validated['payment_amount']) {
                $bookingDetail = BookingDetail::where('booking_id', $request->booking_id)->first();
            if ($bookingDetail) {
                $room = Room::find($bookingDetail->room_id);
                if ($room) {
                    $room->status = 'Còn trống';
                    $room->save();
                }
            }
            return response()->json(['message' => 'Payment amount does not match booking price','rooms' => $room], 400);
        } */
        if ($booking) {
            if ($paymentStatusCode === '00') {
                $booking->status = 'Đã thanh toán';
                $booking->save();
                $payment = Payment::create($validated);
             //Thực hiện các hành động khác sau khi thanh toán thành công (gửi email xác nhận, cập nhật thông tin, vv.)

                return response()->json(['message' => 'Thanh toán thành công','booking'=>$booking]);
            } else {
                $bookingDetail = BookingDetail::where('booking_id', $request->booking_id)->first();
                if ($bookingDetail) {
                    $room = Room::find($bookingDetail->room_id);
                    if ($room) {
                        $room->status = 'Còn trống';
                        $room->save();
                    }
                }
                return response()->json(['message' => 'Thanh toán thất bại hoặc hủy thanh toán','booking'=>$booking,
                'room'=>$room]);
            }
        } else {
            // Không tìm thấy booking tương ứng với mã đơn hàng
            return response()->json(['message' => 'Invalid booking ID']);
        }
    }
    
}
