<?php

namespace App\Http\Controllers;

use App\Models\VoucherCategories;
use Illuminate\Http\Request;

class VoucherCategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = VoucherCategories::all();
        return view('vouchers.category',compact('categories'));
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
            'name' => 'required|unique:branches',
        ]);
        VoucherCategories::Create($request->all());
        return redirect()->back()->with('success',__('Category created successfully') );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\VoucherCategories  $voucherCategories
     * @return \Illuminate\Http\Response
     */
    public function show(VoucherCategories $voucherCategories)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\VoucherCategories  $voucherCategories
     * @return \Illuminate\Http\Response
     */
    public function edit(VoucherCategories $voucherCategories)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\VoucherCategories  $voucherCategories
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, VoucherCategories $category)
    {
        $request->validate([
            'name' => 'required|unique:branches',
        ]);
        $category->update($request->all());
        return redirect()->back()->with('success',__('Category updated successfully') );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\VoucherCategories  $voucherCategories
     * @return \Illuminate\Http\Response
     */
    public function destroy(VoucherCategories $voucherCategories)
    {
        //
    }
}
