<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\OrderShipped;
use App\Order;
use App\Http\Controllers\EmailController;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    public static function enviarEmail(/*Request $request*/){
        $data = Array(
            'name'=>"Saludo",
        );
        Mail::send('verificacion',$data, function($message){
            $email ="eduardodarkar99@gmail.com.com";
            $message->from('17050039@uttcampus.edu.mx'); 
            $message->to(/*$request->email*/'eduardodarkar24@gmail.com')->subject('funciona:C');
        });
        return "Tu correo se envio.";
    }
}
