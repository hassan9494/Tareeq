<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\BlogCategory;
use App\Requests;
use App\Section;

use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use MediaUploader;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts =Post::Where('type','post')->get();
        return view('admin.posts.index', compact('posts'));
    }

    public function setting(){
        $mainServiceDesc = Section::Where('type','service')->first();
        return view('admin.service.setting',compact('mainServiceDesc'));
    }

    public function service()
    {
        $service =Post::Where('type','service')->get();

        $mainServiceDesc = Section::Where('type','service')->first();
        return view('admin.service.service', compact('service','mainServiceDesc'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function serviceRequest(){
        $requests=Requests::whereNotNull('service_id')->orderBy('id', 'DESC')->get();
        foreach ($requests->where('views',0) as $request){
            $request->views =1;
            $request->save();
        }
        return view('admin.service.request',compact('requests'));
    }
    public function create()
    {
        $categoriesBlog=BlogCategory::all();

        return view('admin.posts.create',compact('categoriesBlog'));
    }

    public function serviceCreate(){
        return view('admin.service.create');
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
            'img'=>'image|mimes:jpg,png,jpeg,svg|max:2048',
            'type'=>'required',
            'catBlog' => 'nullable',

        ]);

        foreach(config('locales') as $locale){
            $request->validate([
                'subject_'.$locale => 'required',
                'sh_desc_'.$locale => 'required',
                'desc_'.$locale => 'required',
            ]);
        }
        $post = new Post();

        foreach(config('locales') as $locale){
            $post->setTranslation('subject', $locale,  $request->input('subject_'.$locale));
            $post->setTranslation('sh_desc', $locale,  $request->input('sh_desc_'.$locale));
            $post->setTranslation('desc', $locale,  $request->input('desc_'.$locale));

        }
        //access request data
        $post->type =$request->input('type');
        $post->post_cat_id =$request->input('catBlog');
        $post->hasForm = $request->input('hasForm') == 'on' ? true : false ;
        $post->save();

        //************************uploade photo*******************
        if($request->file('img'))
        {
            $media = MediaUploader::fromSource($request->file('img'))->upload();
            $post->attachMedia($media, 'post');
        }
        if($request->type == 'post'){

            return redirect('admin/posts')->with('success','post created successfully');
        }
        if($request->type == 'service'){

            return redirect('admin/service')->with('success','service created successfully');
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post=Post::find($id);
        return view('admin.posts.show',compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post=Post::find($id);
        $categoriesBlog=BlogCategory::all();

        if($post->type == 'post'){

            return view('admin.posts.edit',compact('post','categoriesBlog'));
        }else{

            return view('admin.service.edit',compact('post'));
        }
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
        $request->validate([
            'img'=>'image|mimes:jpg,png,jpeg,svg|max:2048',
            'type' =>'required',
            'catBlog' => 'nullable',
        ]);
        foreach(config('locales') as $locale){
            $request->validate([
                'subject_'.$locale => 'required',
                'sh_desc_'.$locale => 'required',
                'desc_'.$locale => 'required',



            ]);
        }
        $post=Post::find($id);
        $post->type=$request->input('type');

        foreach(config('locales') as $locale){
            $post->setTranslation('subject', $locale,  $request->input('subject_'.$locale));
            $post->setTranslation('sh_desc', $locale,  $request->input('sh_desc_'.$locale));
            $post->setTranslation('desc', $locale,  $request->input('desc_'.$locale));
        }
        $post->post_cat_id =$request->input('catBlog');
        $post->hasForm = $request->input('hasForm') == 'on' ? true : false ;
        $post->save();

        //************************uploade photo*******************
        if($request->file('img')) {
            $media = MediaUploader::fromSource($request->file('img'))->upload();
            $post->syncMedia($media, 'post');
        }
        if($request->type == 'post'){

            return redirect('admin/posts')->with('success','post updated successfully');
        }
        if($request->type == 'service'){

            return redirect('admin/service')->with('success','service updated successfully');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {

        $post=Post::find($id);
         $post->delete();

        if($post->type == 'post'){

            return  redirect('admin/posts')->with('deleted','post deleted successfully');
        }
        if($post->type == 'service'){

            return redirect('admin/service')->with('success','service created successfully');
        }

    }
}
