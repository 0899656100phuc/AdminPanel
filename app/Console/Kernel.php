<?php

namespace App\Console;

use App\Models\BookingDetail;
use App\Models\Bookings;
use App\Models\Room;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Log;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('checkPay:cron')->everyMinute();
        /* $schedule->call(function () {
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
        })->everyMinute(); */
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
    
}
