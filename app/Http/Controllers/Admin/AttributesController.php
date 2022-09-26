<?php

namespace App\Http\Controllers\Admin;

use App\CategoryProduct;
use App\Models\Attribute;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AttributesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $attributes =Attribute::all();
         $categories = CategoryProduct::whereNull('parent_id')->get();
         return view('admin.product.attributes',compact('attributes','categories'));

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
        $request->validate([
            'category_id'=>'required',
        ]);

        foreach(config('locales') as $locale){
            $request->validate([
                'name_'.$locale => 'required',
            ]);
        }
        $attribute = new Attribute();
        $attribute->category_id=$request->input('category_id');

        foreach(config('locales') as $locale){
            $attribute->setTranslation('name', $locale,  $request->input('name_'.$locale));
        }
        //access request data

        $attribute->save();
        return redirect()->back()->with('success','Attribute Created Successfully');
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Attribute $attribute)
    {
        $request->validate([
            'category_id'=>'required',
        ]);
        foreach(config('locales') as $locale){
            $request->validate([
                'name_'.$locale => 'required',
            ]);
        }
//        dd($attribute);
        $attribute->category_id=$request->input('category_id');
        foreach(config('locales') as $locale){
            $attribute->setTranslation('name', $locale,  $request->input('name_'.$locale));
        }
        $attribute->save();
        return redirect()->back()->with('success','Attribute Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
