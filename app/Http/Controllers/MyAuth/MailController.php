<?php

namespace App\Http\Controllers\MyAuth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function send($token)
    {
        //'text' => 'mail' имя файла с текстом для сообщения
        // массив данных в отправлении, имя здесь
        Mail::send(['html' => 'mail'], ['token'=>$token], function($message)
        {
            //кому и тема
            $message->to('andrey.kunda@tut.by', 'To Taldan') ->subject('Test email');
            $message->from('ogniemimechem@gmail.com', 'From Taldan');
        });
    }

    public function sendForget($token, $id)
    {
        Mail::send(['html' => 'mail_forget'], ['token'=>$token, 'id' => $id], function($message)
        {
            //кому и тема
            $message->to('andrey.kunda@tut.by', 'To Taldan') ->subject('Test email');
            $message->from('ogniemimechem@gmail.com', 'From Taldan');
        });
    }

}
