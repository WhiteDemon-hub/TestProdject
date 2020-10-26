<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use App\SiteModel;
use App\Mail\mark_mail;


class MailController extends Controller
{
    public function send(Request $request)
    {
        // Mail::send(["text" => 'layouts.mail'], ['name' => 'Заказ звонка'], function ($message)
        // {
        //     $message->to(SiteModel::find('1')->email, 'Plans')->subject('Заказ звонка');
        //     $message->from('sword5157@gmail.com', 'Plans');
        // });
        
        //return $request->post('content');

        // if($request->post('email'))

        // $res = $this->validate($request, [
        //     'email' => 'required|email',
        //     'phone' => 'required|min:10|max:10'
        // ]);

        // $res = Validator::make($request->all(),
        // [
        //     'email' => 'required|email',
        //     'phone' => 'required|min:10|max:10'
        // ]);

        // $validator = Validator::make($request->all(), [
        //     'email' => 'required|max:255'
        //     ]);

        // if($validator->fails())
        // {
        //     return response() -> json([
        //         'message' => $validator->errors()
        //     ]);
        // }


        if(filter_var($request->post('email'), FILTER_VALIDATE_EMAIL) && preg_match("/^[0-9]{10,10}+$/", $request->post('phone')))
        {
            Mail::send(new mark_mail($request->all()));
        }
        else
        {
            return response() -> json([
                        'message' => "Введены не корректные данные, запрос не был отправлен!"
                    ]);
        }
    
        
    }

    public function email()
    {
        return view('email');
    }
}
