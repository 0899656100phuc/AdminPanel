<?php

namespace App\Http\Controllers\Mail;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Mail\SendMail;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function index()
    {
        $mailData1 = [
            'title' => 'Mail form Booking',
            'body' => 'this is email smtp',
        ];
        Mail::to('dh51904259@student.stu.edu.vn
        ')->send(new SendMail($mailData1));
        dd('Email successful');
    }
}
