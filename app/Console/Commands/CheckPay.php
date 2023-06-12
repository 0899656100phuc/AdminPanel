<?php

namespace App\Console\Commands;

use App\Models\BookingDetail;
use App\Models\Bookings;
use App\Models\Room;
use Carbon\Carbon;
use Illuminate\Console\Command;

class CheckPay extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'checkPay:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        /*    $bookings = Bookings::where('status', 'Chờ thanh toán')
            ->where('date_booking', '<=', now()->subMinutes(5))
            ->get();

        foreach ($bookings as $booking) {
            $room = $booking->bookingDetailBooking->room;
            if ($room && $room->status == 'Đã đặt') {
                $room->status = 'Còn trống';
                $room->save();
            }
        } */
        $bookings = Bookings::where('status', 'Chờ thanh toán')
            ->where('date_booking', '<=', now()->subMinutes(2))
            ->get();

        foreach ($bookings as $booking) {
            $booking->status = 'Chưa thanh toán';
            $booking->save();

            $booking->bookingDetailBooking->rooms->status = 'Còn trống';
            $booking->bookingDetailBooking->rooms->save();
        }
    }
}
