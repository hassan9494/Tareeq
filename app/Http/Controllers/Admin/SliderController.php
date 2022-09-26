<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Slider;
use Illuminate\Http\Request;
use MediaUploader;
class SliderController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $slider  = Slider::all();
        return view('admin.slider.index',compact('slider'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
             'url'=>'nullable|url',
            'img'=>'required|image|mimes:jpg,png,jpeg|max:3000',
        ]);
        foreach(config('locales') as $locale){
            $request->validate([
                'header_'.$locale => 'nullable',
                'paragraph_'.$locale => 'nullable',
                'Direction_'.$locale => '',
                'btn_name_'.$locale => 'nullable',
            ]);
        }

        //access request data
        $slider = new Slider();
        foreach(config('locales') as $locale){
            $slider->setTranslation('header', $locale,  $request->input('header_'.$locale));
            $slider->setTranslation('paragraph', $locale,  $request->input('paragraph_'.$locale));
            $slider->setTranslation('direction', $locale,  $request->input('Direction_'.$locale));
            $slider->setTranslation('btn_name', $locale,  $request->input('btn_name_'.$locale));
        }

        $slider->url=$request->input('url');
        $slider->save();
        //************************uploade photo*******************
//        dd($slider);
        if($request->file('img')) {
            $media = MediaUploader::fromSource($request->file('img'))->upload();
            $slider->attachMedia($media, 'slider');
        }

        return redirect('admin/slider')->with('success','slider created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $slider=Slider::find($id);
        return view('admin.slider',compact('slider'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $slider=Slider::find($id);
        return view('admin.slider.edit',compact('slider'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Slider $slider)
    {

        //validation

        $request->validate([
            'url'=>'nullable|url',
            'img'=>'image|mimes:jpg,png,jpeg|max:3000',
        ]);
        foreach(config('locales') as $locale){
            $request->validate([
                'header_'.$locale => 'nullable',
                'paragraph_'.$locale => 'nullable',
                'Direction_'.$locale => '',
                'btn_name_'.$locale => 'nullable',
            ]);
        }


        //access request data
        $slider->url = $request->url;
        foreach(config('locales') as $locale){
            $slider->setTranslation('header', $locale,  $request->input('header_'.$locale));
            $slider->setTranslation('paragraph', $locale,  $request->input('paragraph_'.$locale));
            $slider->setTranslation('direction', $locale,  $request->input('Direction_'.$locale));
            $slider->setTranslation('btn_name', $locale,  $request->input('btn_name_'.$locale));
        }
        $slider->save();

        //************************uploade photo*******************
        if($request->file('img')) {
            $media = MediaUploader::fromSource($request->file('img'))->upload();
            $slider->syncMedia($media, 'slider');
        }
        return redirect()->back()->with('success', "Slide $slider->header added successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $slider=Slider::find($id);
        $slider->delete();
        return redirect()->back()->with('success', "Slide $slider->header removed successfully");
    }
}
