<?php

namespace App\Http\Controllers\Admin;
use App\Section;
use App\Http\Controllers\Controller;

use App\Feature;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use MediaUploader;

class FeatureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $features=Feature::all();
        $featureSetting =Section::Where('type','feature')->first();
        return view('admin.Features.index',compact('features','featureSetting'));
    }

    public function featureSetting(){

        $featureSetting =Section::Where('type','feature')->first();

        return view('admin.Features.featureSetting',compact('featureSetting'));

    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.Features.create');

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
        foreach(config('locales') as $locale){
            $request->validate([
                'title_'.$locale => 'required',
                'desc_'.$locale => 'required',

            ]);
        }
        $feature = new Feature();
        foreach(config('locales') as $locale){
            $feature->setTranslation('title', $locale,  $request->input('title_'.$locale));
            $feature->setTranslation('desc', $locale,  $request->input('desc_'.$locale));
        }

        $feature->save();
        //************************uploade photo*******************
        if($request->file('img'))
        {
            $media = MediaUploader::fromSource($request->file('img'))->upload();
            $feature->attachMedia($media, 'feature');
        }
        return redirect()->back()->with('success','feature created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $feature=Feature::find($id);
        return view('admin.Features.edit',compact('feature'));
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
        foreach(config('locales') as $locale){
            $request->validate([
                'title_'.$locale => 'required',
                'desc_'.$locale => 'required',

            ]);
        }
        $feature=Feature::find($id);

        foreach(config('locales') as $locale){
            $feature->setTranslation('title', $locale,  $request->input('title_'.$locale));
            $feature->setTranslation('desc', $locale,  $request->input('desc_'.$locale));
        }

        $feature->save();
        //************************uploade photo*******************
        if($request->file('img'))
        {
            $media = MediaUploader::fromSource($request->file('img'))->upload();
            $feature->attachMedia($media, 'feature');
        }
        return redirect('admin\feature')->with('success','feature updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $feature=Feature::find($id);
        $feature->delete();

        return  redirect('admin/feature')->with('deleted','feature deleted successfully');
    }
}
