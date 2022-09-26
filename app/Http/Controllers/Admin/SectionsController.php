<?php

namespace App\Http\Controllers\Admin;
use App\Section;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use MediaUploader;

class SectionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $active=Section::where('active', 1)->orderBy('order')->get();
        $deActive=Section::where('active', 0)->get();

        return view('admin.sortSection.index',compact('active','deActive'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        dd($request->all());
        if ($request->active) {
            foreach ($request->active as $section) {
                $getSection = Section::find($section['id']);
                $getSection->order = $section['order'];
                $getSection->active = 1;
                $getSection->save();

            }
        }
        if ($request->deActive) {
            foreach ($request->deActive as $section) {
                $getSection = Section::find($section['id']);
                $getSection->active = 0;
                $getSection->save();

            }
        }
        return redirect()->back();
//        dd(SortSection::all());
    }

    public function about(){
        $aboutUs=Section::first();
        return view('admin.home.aboutUs',compact('aboutUs'));
    }
    public function freetrial(){
        $freetrial=Section::where('type','freetrial')->first();
        return view('admin.'.setting('theme.admin').'.home.freetrial',compact('freetrial'));
    }

// update section setting
    public function update(Request $request){
        //validation
        foreach(config('locales') as $locale){
            $request->validate([
                'name_'.$locale => 'nullable',
                'sh_desc_'.$locale => 'nullable',
                'description_'.$locale => 'nullable',
            ]);
        }

        $request->validate([
            'img'=>'image|mimes:jpg,png,jpeg|max:10048|nullable',
            'backgroundColor'=>'nullable',
            'backgroundImage'=>'image|mimes:jpg,png,jpeg|nullable',
            'type'=>'required',
        ]);

        $aboutUs = Section::Where('type',$request->type)->first();

        foreach(config('locales') as $locale){
            $aboutUs->setTranslation('name', $locale,  $request->input('name_'.$locale));
            $aboutUs->setTranslation('sh_desc', $locale,  $request->input('sh_desc_'.$locale));
            $aboutUs->setTranslation('description', $locale,  $request->input('description_'.$locale));
        }
        $aboutUs->backgroundColor=$request->backgroungColor;

        $aboutUs->save();
        //************************uploade image background*******************

        if($request->file('backgroundImage')) {
            $media = MediaUploader::fromSource($request->file('backgroundImage'))->upload();
            $aboutUs->syncMedia($media, 'backgroundImage');
        }
        //************************uploade photo*******************
        if($request->file('img')) {
            $media = MediaUploader::fromSource($request->file('img'))->upload();
            $aboutUs->syncMedia($media, 'about');
        }
        return redirect()->back()->with('success', "setting section added successfully");

    }



    /** add description service **/
    public function updateMainDesc(Request $request){
        //validation
        foreach(config('locales') as $locale){
            $request->validate([
                'name_'.$locale => 'nullable',
                'description_'.$locale => 'nullable',
            ]);
        }
        $request->validate([
            'img'=>'image|mimes:jpg,png,jpeg|max:3000|nullable',
            'backgroundColor'=>'nullable',
            'backgroundImage'=>'image|mimes:jpg,png,jpeg|nullable',
            'type'=>'required',
        ]);
        $mainServiceDesc = Section::Where('type','service')->first();
        foreach(config('locales') as $locale){
            $mainServiceDesc->setTranslation('name', $locale,  $request->input('name_'.$locale));
            $mainServiceDesc->setTranslation('description', $locale,  $request->input('description_'.$locale));
        }
        $mainServiceDesc->backgroundColor=$request->input('backgroungColor');

        $mainServiceDesc->save();
        //************************uploade image background*******************
        if($request->file('backgroundImage')) {
            $media = MediaUploader::fromSource($request->file('backgroundImage'))->upload();
            $mainServiceDesc->syncMedia($media, 'service');
        }
        //************************uploade photo*******************
        if($request->file('img')) {
            $media = MediaUploader::fromSource($request->file('img'))->upload();
            $mainServiceDesc->syncMedia($media, 'service');
        }

        return redirect()->back()->with('success', "Main Description For Service Added Successfully");

    }
}
