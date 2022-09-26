<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Section;
use App\Post;
use App\Slider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use MediaUploader;
use Plank\Mediable\Media;
Use RealRashid\SweetAlert\Facades\Alert;
class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories=Category::all();
        return view('admin.categories.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(){

    }
    public function categories()
    {
        $categories=Category::all();
        $gallary = Section::Where('type','portfolio')->first();
        return view('admin.categories.showCategories',compact('categories','gallary'));
    }

    public function setting(){
        $gallary = Section::Where('type','portfolio')->first();
        return view('admin.categories.setting',compact('gallary'));
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
                'name_'.$locale => 'required',
            ]);
        }
        $category = new Category();
        foreach(config('locales') as $locale){
            $category->setTranslation('name', $locale,  $request->input('name_'.$locale));
        }

        $category->save();
        return redirect('admin/categories')->with('success','category created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function addImage(Request $request)
    {
        $request->validate([
            'img'=>'image|mimes:jpg,png,jpeg|max:3000',
            'category'=>'required'
        ]);
        $cat = Category::find($request->category);
        if($request->file('img')) {
            $media = MediaUploader::fromSource($request->file('img'))->upload();
            foreach(config('locales') as $locale){
                $media->setTranslation('description', $locale,  $request->input('description_'.$locale));
            }
            $media->save();

            $cat->attachMedia($media, 'cat');
        }

         return redirect('admin/category')->with('success','img added successfully');
    }

    public function deleteImage(Request $request,$media){

        $media2=Media::find($media);
        $media2->delete();
        return redirect('admin/category')->with('success','img deleted successfully');

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
                'name_'.$locale => 'required',
            ]);
        }
        $category=Category::find($id);
        foreach(config('locales') as $locale){
            $category->setTranslation('name', $locale,  $request->input('name_'.$locale));
        }
        $category->save();

        return redirect('admin/categories')->with('success','category update successfully');
    }

        public function updateImage(Request $request, Media $image){

            //validation
            $request->validate([
                'description'=>'required'
            ]);

            $image->description = $request->description;
            $image->save();

    //
            return redirect()->back()->with('success', "update successfully");
        }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $cat=Category::find($id);
        $cat->delete();
        return  redirect('admin/categories')->with('deleted','category deleted successfully');
    }
}
