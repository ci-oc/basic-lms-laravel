<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\MailTrap;

class MailController extends Controller
{
    public static function index($password,$to){

        if(Mail::send('student.mail', compact('password'), function($message)
        {
            $message->to('TEST@GMAIL.COM');
            $message->subject('Welcome to FCIH-MODULE');
            $message->from('sender@domain.net');
        })) return true;
    }
    public function StudentView(){ // for testing view
        return view('student.mail');
    }

    public function instructorView(){ // for testing view
        return view('instructor.PDFmail');
    }
    public function AttachmentMail($email,$filePath){
        if(Mail::send('student.mail', array(), function($message)
        {
            $message->to('mail@domain.net');
            $message->subject('Welcome to Laravel');
            $message->from('sender@domain.net'); // will be cahanged when hosted
            $message->attachData('background.jpg','photo.jpg');
        })) return true;
    }
}
