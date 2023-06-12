<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bookings;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Bookings::with('customer')->get();
        //$bookings = Bookings::all();
        return view('admin.booking.booking', ['bookings' => $bookings]);
    }
}
