<?php

namespace App\Http\Controllers\Admin;

use App\Models\Package;
use App\Models\PackageTime;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PackageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        dd('index');
        $packages = Package::all();
        return view('admin.package.index',compact('packages'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $packageTimes = PackageTime::all();
        return view('admin.package.create',compact('packageTimes'));
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
            'package_time_id' =>'required|integer',
            'days' =>'required|integer',
            'classes' =>'required|integer',
            'class_price' =>'required',
            'total_price' =>'required',
            'Months12'=>'required',
            'Months6'=>'required'
        ]);
        Package::Create($request->all());
        return redirect()->route('admin.package.index')->with('success','Package Added Successfully');
    }
    public function packageTime(Request $request)
    {
        $request->validate([
           'time' =>'required|integer|min:15'
        ]);
        PackageTime::Create($request->all());
        return redirect()->back()->with('success','Package Time Added Successfully');
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
    public function edit(Package $package)
    {
        $packageTimes = PackageTime::all();
        return view('admin.package.edit',compact('package','packageTimes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Package $package)
    {
        $request->validate([
            'package_time_id' =>'required|integer',
            'days' =>'required|integer',
            'classes' =>'required|integer',
            'class_price' =>'required',
            'total_price' =>'required',

        ]);
        $package->update($request->all());
        return redirect()->route('admin.package.index')->with('success','Package Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Package $package)
    {
        $package->delete();
        return redirect()->back()->with('success','Package Deleted Successfully');

    }
}
