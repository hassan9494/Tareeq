<?php


namespace App\Http\Controllers\Frontend;
use App\Message;
use App\Requests;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

class MessagesController extends Controller
{
    public function store(Request $request)
    {

        //validation
        $request->validate([
            'name' => 'required',
            'email'=>'email|required',
            'phone'=>'required',
            'note'=>'nullable'
        ]);
        Message::Create($request->all());

        return redirect()->back()->with('success','Request done');

    }

}
