<?php

namespace App\Http\Controllers\Admin;

use App\Team;
use App\Section;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use MediaUploader;

class TeamsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $teams =Team::all();
        $teamSection=Section::Where('type','teams')->first();
        return view('admin.teams.index', compact('teams','teamSection'));
        //
    }
    public function setting(){
        $teamSection=Section::Where('type','teams')->first();
        return view('admin.teams.setting',compact('teamSection'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.teams.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'img.*'=>'image|mimes:jpg,png,jpeg,svg|max:3000',
             'facebook'=>'url|nullable',
             'twitter'=>'url|nullable',
             'linkedIn'=>'url|nullable',

        ]);
        //validation
        foreach(config('locales') as $locale){
            $request->validate([
                'name_'.$locale => 'required',
                'desc_'.$locale => 'required',
            ]);
        }
        $team = new Team();
        foreach(config('locales') as $locale) {
            $team->setTranslation('name', $locale, $request->input('name_' . $locale));
            $team->setTranslation('desc', $locale, $request->input('desc_' . $locale));

        }

        $team->facebook =$request->input('facebook');
        $team->twitter =$request->input('twitter');
        $team->linkedIn =$request->input('linkedIn');
        $team->save();

        //************************uploade photo*******************
        if($request->file('img'))
        {
            $media = MediaUploader::fromSource($request->file('img'))->upload();
            $team->attachMedia($media, 'team');
        }
        return redirect()->route('admin.teams.index')->with('success', "Team $team->name added successfully");

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $team=Team::find($id);
        return view('admin.teams.show',compact('team'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $team=Team::find($id);
        return view('admin.teams.edit',compact('team'));
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
            'img.*'=>'image|mimes:jpg,png,jpeg,svg|max:3000',
            'facebook'=>'url|nullable',
            'twitter'=>'url|nullable',
            'linkedIn'=>'url|nullable',

        ]);
        foreach(config('locales') as $locale){
            $request->validate([
                'name_'.$locale => 'required',
                'desc_'.$locale => 'required',
            ]);
        }
        $team=Team::find($id);

        foreach(config('locales') as $locale){
            $team->setTranslation('name', $locale,  $request->input('name_'.$locale));
            $team->setTranslation('desc', $locale,  $request->input('desc_'.$locale));

        }
        $team->facebook =$request->input('facebook');
        $team->twitter =$request->input('twitter');
        $team->linkedIn =$request->input('linkedIn');
        $team->save();

        //************************uploade photo*******************
        if($request->file('img'))
        {
            $media = MediaUploader::fromSource($request->file('img'))->upload();
            $team->attachMedia($media, 'team');
        }
        return redirect()->route('admin.teams.index')->with('success', "Team $team->name added successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $team=Team::find($id);
        $team->delete();

        return  redirect('admin/teams')->with('deleted','Teams deleted successfully');
    }
}
