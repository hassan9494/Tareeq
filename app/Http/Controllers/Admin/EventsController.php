<?php

namespace App\Http\Controllers\Admin;

use App\Event;
use App\Section;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use MediaUploader;

class EventsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events =Event::all();
        $eventSection=Section::Where('type','event')->first();
        return view('admin.events.index', compact('events','eventSection'));
        //
    }
    public function setting(){
        $eventSection=Section::Where('type','event')->first();
        return view('admin.events.setting',compact('eventSection'));
    }
   /* active event */
    public function active(Request $request ,Event $event){
        $event->active =$request->active;
        $event->save();
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.events.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validation
        $request->validate([
            'start_date'=>'nullable|date|before_or_equal:end_date',
            'end_date'=>'nullable|date|after_or_equal:start_date',
            'img.*'=>'image|mimes:jpg,png,jpeg,svg|max:3000',

        ]);
        foreach(config('locales') as $locale){
            $request->validate([
                'name_'.$locale => 'required',
                'sh_desc_'.$locale => 'required',
                'desc_'.$locale => 'required',
            ]);
        }
        $event = new Event();
        foreach(config('locales') as $locale){
            $event->setTranslation('name', $locale,  $request->input('name_'.$locale));
            $event->setTranslation('sh_desc', $locale,  $request->input('sh_desc_'.$locale));
            $event->setTranslation('desc', $locale,  $request->input('desc_'.$locale));

        }
        $event->start_date =$request->input('start_date');
        $event->end_date =$request->input('end_date');
        $event->save();

        //************************uploade photo*******************
        if($request->file('img'))
        {
            $media = MediaUploader::fromSource($request->file('img'))->upload();
            $event->attachMedia($media, 'event');
        }
        return redirect()->route('admin.events.index')->with('success', "Event $event->name added successfully");

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $event=Event::find($id);
        return view('admin.events.show',compact('event'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $event=Event::find($id);
        return view('admin.events.edit',compact('event'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        //validation
        $request->validate([
            'start_date'=>'nullable|date|before_or_equal:end_date',
            'end_date'=>'nullable|date|after:start_date',
            'img.*'=>'image|mimes:jpg,png,jpeg,svg|max:3000',

        ]);
        foreach(config('locales') as $locale){
            $request->validate([
                'name_'.$locale => 'required',
                'sh_desc_'.$locale => 'required',
                'desc_'.$locale => 'required',
            ]);
        }
        $event=Event::find($id);

        foreach(config('locales') as $locale){
            $event->setTranslation('name', $locale,  $request->input('name_'.$locale));
            $event->setTranslation('sh_desc', $locale,  $request->input('sh_desc_'.$locale));
            $event->setTranslation('desc', $locale,  $request->input('desc_'.$locale));

        }
        $event->start_date =$request->input('start_date');
        $event->end_date =$request->input('end_date');
        $event->save();

        //************************uploade photo*******************
        if($request->file('img'))
        {
            $media = MediaUploader::fromSource($request->file('img'))->upload();
            $event->attachMedia($media, 'event');
        }
        return redirect()->route('admin.events.index')->with('success', "Event $event->name added successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $event=Event::find($id);
        $event->delete();

        return  redirect('admin/events')->with('deleted','Event deleted successfully');
    }
}
