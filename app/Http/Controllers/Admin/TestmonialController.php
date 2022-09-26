<?php

namespace App\Http\Controllers\Admin;
use App\Testmonial;
use App\Section;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use MediaUploader;

class TestmonialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $testmonials =Testmonial::all();
        $testmonialSection=Section::Where('type','testmonials')->first();
        return view('admin.testmonials.index', compact('testmonials','testmonialSection'));
    }

    public function setting(){
        $testmonialSection=Section::Where('type','testmonials')->first();
        return view('admin.testmonials.setting',compact('testmonialSection'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.testmonials.create');
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

        ]);
        //validation
        foreach(config('locales') as $locale){
            $request->validate([
                'name_'.$locale => 'required',
                'desc_'.$locale => 'required',
            ]);
        }
        $testmonial = new Testmonial();
        foreach(config('locales') as $locale) {
            $testmonial->setTranslation('name', $locale, $request->input('name_' . $locale));
            $testmonial->setTranslation('desc', $locale, $request->input('desc_' . $locale));

        }
        $testmonial->save();

        //************************uploade photo*******************
        if($request->file('img'))
        {
            $media = MediaUploader::fromSource($request->file('img'))->upload();
            $testmonial->attachMedia($media, 'testmonial');
        }
        return redirect()->route('admin.testmonials.index')->with('success', "testmonial $testmonial->name added successfully");

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $testmonial=Testmonial::find($id);
        return view('admin.testmonials.show',compact('testmonial'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $testmonial=Testmonial::find($id);
        return view('admin.testmonials.edit',compact('testmonial'));
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

        ]);
        foreach(config('locales') as $locale){
            $request->validate([
                'name_'.$locale => 'required',
                'desc_'.$locale => 'required',
            ]);
        }
        $testmonial=Testmonial::find($id);

        foreach(config('locales') as $locale){
            $testmonial->setTranslation('name', $locale,  $request->input('name_'.$locale));
            $testmonial->setTranslation('desc', $locale,  $request->input('desc_'.$locale));

        }
        $testmonial->save();

        //************************uploade photo*******************
        if($request->file('img'))
        {
            $media = MediaUploader::fromSource($request->file('img'))->upload();
            $testmonial->attachMedia($media, 'testmonial');
        }
        return redirect()->route('admin.testmonials.index')->with('success', "Testmonial $testmonial->name added successfully");    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $testmonial=Testmonial::find($id);
        $testmonial->delete();

        return  redirect('admin/testmonials')->with('deleted','testmonials deleted successfully');
    }
}
