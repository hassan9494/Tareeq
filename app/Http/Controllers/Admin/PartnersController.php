<?php

namespace App\Http\Controllers\Admin;

use App\Partner;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Plank\Mediable\Media;
use MediaUploader;


class PartnersController extends Controller
{
    public function partners(){
        return view('admin.home.partners.Partners');
    }
//    public function logo(){
//        return view('admin.home.partners.logo');
//  }
    public function store(Request $request){
        //validation

        $request->validate([
            'url'=>'nullable|url',
            'img'=>'image|mimes:jpg,png,jpeg|max:3000',
            'type'=>'required',
        ]);
        $partners=new Partner();
        $partners->url=$request->input('url');
        $partners->type=$request->input('type');
//        $partners->img = $request->input('img');

          $partners->save();
         //************************uploade photo*******************
        if($request->file('img')) {
            $media = MediaUploader::fromSource($request->file('img'))->upload();
            $partners->syncMedia($media, 'partnersBackeground');
        }

        return redirect()->back()->with('success', "Partner added successfully");
    }
    public function storeLogo(Request $request){
        //validation
        $request->validate([
            'url'=>'nullable|url',
            'img'=>'image|mimes:jpg,png,jpeg|max:3000',
            'type'=>'required'
        ]);
        $partners=new Partner();
        $partners->url=$request->input('url');
        $partners->type=$request->input('type');

//        $partners->img = $request->input('img');

        $partners->save();
        //************************uploade photo*******************
        if($request->file('img')) {
            $media = MediaUploader::fromSource($request->file('img'))->upload();
            $partners->syncMedia($media, 'partnersLogo');
        }

        return redirect()->back()->with('success', "Partner logo added successfully");
    }

    public function showImages(){

        $partnersBackeground =Partner::Where('type','partnersBackeground')->orderBy('created_at','desc')->first();
        $partnersLogo =Partner::Where('type','partnersLogo')->get();
        return view('admin.home.partners.images',compact('partnersBackeground','partnersLogo'));
    }


    public function update(Request $request, Partner $image){
        //validation

        $request->validate([
            'url'=>'nullable|url',
            'img'=>'image|mimes:jpg,png,jpeg|max:2048',
            'type'=>'required'
        ]);
        $image->url=$request->input('url');
        $image->type=$request->input('type');
        $image->save();

        //************************uploade photo*******************
        if($request->file('img')) {
            $media = MediaUploader::fromSource($request->file('img'))->upload();
            $image->syncMedia($media, 'partnersLogo');
        }

        return redirect()->back()->with('success', "partnerLogo updated successfully");
    }
    public function delete(Partner $image){

        $image->delete();
        return redirect()->back()->with('success','img deleted successfully');
    }

    public function deleteBackground(Partner $image){
        $image->delete();
        return redirect()->back()->with('success','Bachground image deleted successfully');
    }
}
