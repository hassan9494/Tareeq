<?php

namespace App\Http\Controllers\Admin;;
use App\Section;
use App\CategoryProduct;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use MediaUploader;

class CategoryProductController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $categoriesProduct=CategoryProduct::all();
        $categorySection= Section::Where('type','catProduct')->first();
        return view('admin.product.categoriesProduct',compact('categoriesProduct','categorySection'));
    }
   public function setting(){
       $categorySection= Section::Where('type','catProduct')->first();
       return view('admin.product.setting',compact('categorySection'));

   }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categoriesProduct=CategoryProduct::whereNull('parent_id')->get();
        return view('admin.product.createCategoryProduct',compact('categoriesProduct'));
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
            'img'=>'image|mimes:jpg,png,jpeg,svg|max:3000',
        ]);
        foreach(config('locales') as $locale){
            $request->validate([
                'name_'.$locale => 'required',
                'desc_'.$locale => 'required',
            ]);
        }
        $categoryProduct = new CategoryProduct();
//        $categoryProduct->parent_id=$request->input('parentCategory');
        $count =CategoryProduct::max('id')+1;
        $categoryProduct->slug =$request->input('name_en').' '.$count ;
        //access request data
        foreach(config('locales') as $locale){
            $categoryProduct->setTranslation('name', $locale,  $request->input('name_'.$locale));
            $categoryProduct->setTranslation('desc', $locale,  $request->input('desc_'.$locale));
        }

        $categoryProduct->save();
        //************************uploade photo*******************
        if($request->file('img'))
        {
            $media = MediaUploader::fromSource($request->file('img'))->upload();
            $categoryProduct->attachMedia($media, 'catproduct');
        }
        return redirect()->back()->with('success','Category  created successfully');

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
    public function subCategory(CategoryProduct $category )
    {
        $sub  = $category->children()->pluck('name','id');
        return  json_encode($sub);
    }
    public function attributes(CategoryProduct $category )
    {
        $sub  = $category->attributes()->pluck('name','id');
        return  json_encode($sub);
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
            'img'=>'image|mimes:jpg,png,jpeg,svg|max:3000',
        ]);
        $request->validate([
            'parentCategory'=>'nullable'
        ]);

        foreach(config('locales') as $locale){
            $request->validate([
                'name_'.$locale => 'required',
                'desc_'.$locale => 'required',
            ]);
        }
        $categoryProduct =CategoryProduct::find($id);
        $categoryProduct->parent_id=$request->input('parentCategory');

        foreach(config('locales') as $locale){
            $categoryProduct->setTranslation('name', $locale,  $request->input('name_'.$locale));
            $categoryProduct->setTranslation('desc', $locale,  $request->input('desc_'.$locale));
        }

        $categoryProduct->save();

        //************************uploade photo*******************
        if($request->file('img'))
        {
            $media = MediaUploader::fromSource($request->file('img'))->upload();
            $categoryProduct->attachMedia($media, 'catproduct');
        }
        return redirect()->back()->with('success','Category  updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $categoryProduct=CategoryProduct::find($id);
        if ( $categoryProduct->products()->count() > 0 ) {
            return  redirect()->back()->with('error','can`t deleted this category because it contains courses');
        }else{

            $categoryProduct->delete();
            return  redirect()->back()->with('success','Category  deleted successfully');
        }

    }
}
