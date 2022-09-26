<?php

namespace App\Http\Controllers\Admin;


use App\Http\Requests\VoucherRequest;
use App\Models\Supplier;
use App\Models\Voucher;
use App\Models\VoucherCategories;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;

class VoucherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->method() == 'GET'){
            $vouchers = Voucher::where('type','expense')->get();
        }else{
            $vouchers = Voucher::where('type','expense')->get()->whereBetween('created_at',[$request->from.' 00:00:00',$request->to.' 24:00:00']);
        }
        return view('admin.vouchers.purchase.index',compact('vouchers'));
    }
    public function income(Request $request)
    {
        if ($request->method() == 'GET'){
            $vouchers = Voucher::where('type','income')->get();
            foreach ($vouchers->where('view',0) as $voucher ){
                $voucher->view = 1;
                $voucher->save();
            }
        }else{
            $vouchers = Voucher::where('type','income')->get()->whereBetween('created_at',[$request->from.' 00:00:00',$request->to.' 24:00:00']);
        }
        return view('admin.vouchers.sales.index',compact('vouchers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $suppliers = Supplier::all()->pluck('name','id');
        $categories = VoucherCategories::all()->pluck('name','id');
        $users = User::all()->pluck('name','id');
        return view('vouchers.purchase.create',compact('suppliers','categories','users'));
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
$request->merge(['type'=>'expense']);
        $voucher = Voucher::Create($request->all());

            return redirect()->back()->with('success','Done');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Voucher  $voucher
     * @return \Illuminate\Http\Response
     */
    public function show(Voucher $voucher)
    {
//        dd($voucher);
        return view('vouchers.purchase.show',compact('voucher'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Voucher  $voucher
     * @return \Illuminate\Http\Response
     */
    public function edit(Voucher $voucher)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Voucher  $voucher
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Voucher $voucher)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Voucher  $voucher
     * @return \Illuminate\Http\Response
     */
    public function destroy(Voucher $voucher)
    {
        //
    }
}
