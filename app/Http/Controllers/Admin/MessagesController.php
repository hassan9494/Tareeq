<?php

namespace App\Http\Controllers\Admin;

use App\Message;
use App\Models\Job;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MessagesController extends Controller
{
    public function index()
    {
        $messages=Message::all();
        foreach (Message::where('views',0)->get() as $message){
            $message->views =1;
            $message->save();
        }
        return view('admin.messages',compact('messages'));
    }
    public function jobs()
    {
        $messages=Job::all();
        foreach (Job::where('view',0)->get() as $message){
            $message->view =1;
            $message->save();
        }
        return view('admin.jobs',compact('messages'));
    }
}
