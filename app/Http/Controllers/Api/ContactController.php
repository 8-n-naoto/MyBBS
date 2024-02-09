<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMail;
use App\Models\Tag;
use App\Models\CakeInfo;

class ContactController extends Controller
{
    public function _send_ContactMail()
    {
        // $to=[[
        //     'email'=>'nfami8naoto@gmail.com',
        //     'name'=>'お店の名前',
        // ]];

        // Mail::to($to)->send(new ContactMail());

    }
}
