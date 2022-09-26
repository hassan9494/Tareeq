<?php

namespace App\Http\Controllers\Admin;

use App\BlogCategory;
use App\Section;
use App\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
//use Plank\Mediable\MediaUploader;
use MediaUploader;

class BlogCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $categoryBlog=BlogCategory::all();
        $category = Section::Where('type','blog')->first();
//        dd($category);
        return view('admin.posts.BlogCategory',compact('categoryBlog','category'));
    }
    public function setting(){
        $category = Section::Where('type','blog')->first();
        return view('admin.posts.setting',compact('category'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.posts.createCategoryBlog');
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
            'img'=>'image|mimes:jpg,png,jpeg,svg|max:3000',
        ]);

        foreach(config('locales') as $locale){
            $request->validate([
                'name_'.$locale => 'required',
                'desc_'.$locale => 'required',
            ]);
        }
        $categoryBlog = new BlogCategory();
        foreach(config('locales') as $locale){
            $categoryBlog->setTranslation('name', $locale,  $request->input('name_'.$locale));
            $categoryBlog->setTranslation('desc', $locale,  $request->input('desc_'.$locale));
        }
        //access request data

        $categoryBlog->save();

        //************************uploade photo*******************
        if($request->file('img'))
        {
            $media = MediaUploader::fromSource($request->file('img'))->upload();
            $categoryBlog->attachMedia($media, 'catBlog');
        }
           return redirect()->back()->with('success','Category Blog created successfully');

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
     * Show the form for editing the specified resourc

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
            'img'=>'image|mimes:jpg,png,jpeg,svg|max:2048',
        ]);

        foreach(config('locales') as $locale){
            $request->validate([
                'name_'.$locale => 'required',
                'desc_'.$locale => 'required',
            ]);
        }
        $categoryBlog =BlogCategory::find($id);
        foreach(config('locales') as $locale){
            $categoryBlog->setTranslation('name', $locale,  $request->input('name_'.$locale));
            $categoryBlog->setTranslation('desc', $locale,  $request->input('desc_'.$locale));
        }

        $categoryBlog->save();

        //************************uploade photo*******************
        if($request->file('img'))
        {
            $media = MediaUploader::fromSource($request->file('img'))->upload();
            $categoryBlog->attachMedia($media, 'catBlog');
        }
        return redirect()->back()->with('success','Category Blog updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $categoryBlog=BlogCategory::find($id);
        $categoryBlog->delete();
            return  redirect()->back()->with('deleted','Category Blog deleted successfully');

    }
}
