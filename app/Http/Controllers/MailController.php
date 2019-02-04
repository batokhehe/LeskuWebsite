<?php

namespace App\Http\Controllers;
use App\Mail\LeskuEmailer;
use Illuminate\Support\Facades\Mail;

use Illuminate\Http\Request;

class MailController extends Controller
{
    //
    public function send()
    {
        $objDemo = new \stdClass();
        $objDemo->demo_one = 'Demo One Value';
        $objDemo->demo_two = 'Demo Two Value';
        $objDemo->sender = 'Admin Lesku';
        $objDemo->receiver = 'Batok';
 
        if(!Mail::to("dhikanaufal@gmail.com")->send(new LeskuEmailer($objDemo))){
        	return 'Email was sent';
        } else {
        	return 'Failed to send Email';
        }


    }
}
