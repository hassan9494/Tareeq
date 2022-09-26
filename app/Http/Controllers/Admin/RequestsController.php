<?php

namespace App\Http\Controllers\Admin;

use App\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RequestsController extends Controller
{
    public function service()
    {
        $requests=Requests::whereNotNull('service_id')->get();
        foreach ($requests->where('views',0) as $request){
            $request->views =1;
            $request->save();
        }
        return view('admin.service.request',compact('requests'));
    }
    public function page()
    {
        $requests=Requests::whereNotNull('page_id')->get();
        foreach ($requests->where('views',0) as $request){
            $request->views =1;
            $request->save();
        }
        return view('admin.pages.requests',compact('requests'));
    }
}
