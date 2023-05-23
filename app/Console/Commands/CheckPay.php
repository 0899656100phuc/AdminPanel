<?php

namespace App\Console\Commands;

use App\Models\BookingDetail;
use App\Models\Bookings;
use App\Models\Room;
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
        
        $bookings = Bookings::where('status', 'Chưa thanh toán')
                ->where('date_booking', '>=', now()->subMinutes(1))
                ->get();
    
            foreach ($bookings as $booking) {
                $bookingDetail = BookingDetail::where('booking_id', $booking->id)->first();
                if ($bookingDetail) {
                    $room = Room::find($bookingDetail->room_id);
                    if ($room) {
                        $room->status = 'Còn trống';
                        $room->save();
                        
                    }
                }
            }
    }
    
    
}
