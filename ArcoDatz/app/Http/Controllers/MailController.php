<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\NewCustomerMail;
use Redirect;
use Mail;


class MailController extends Controller
{
    //
    public function newCust(Request $request) {
    // $data = new \stdClass();
    //    $data->sender = $request->sender;
    //    $data->title = $request->title;
    //    $data->body = $request->body;

    $data = array(
    'sender'   =>  $request->sender,
    'title'   =>  $request->title,
    'body'   =>   $request->body
    );
        
    //dd($data);
    Mail::to('administrator@ArcoDatz.com.ph')->send(new NewCustomerMail($data));
    return Redirect::back()->with('success','Email sent Successfully!');
    }

    public function checkupMail(Request $request) {
    // $data = new \stdClass();
    //    $data->sender = $request->sender;
    //    $data->title = $request->title;
    //    $data->body = $request->body;

    $data = array(
    'sender'   =>  $request->sender,
    'title'   =>  $request->title,
    'body'   =>   $request->body
    );
        
    //dd($data);
    Mail::to($request->sender)->send(new CheckupMail($data));
    return Redirect::back()->with('success','Email sent Successfully!');
    }

}
