<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\MailTrap;

class MailController extends Controller
{
    public function index(){
        Mail::to('minamofreh35@gmail.com')->send(new Mailtrap());
    }
    public function view(){
        return view('student.mail');
    }
}
