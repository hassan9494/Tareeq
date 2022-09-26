<?php

namespace App\Http\Controllers\Admin;

use App\OrderProduct;
use App\Provider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;

class ProvidersController extends Controller
{
    public function index()
    {
        $providers = Provider::all();
        return view('admin.providers.index', compact('providers'));
    }

    public function create()
    {

        return view('admin.providers.create');
    }

    public function store(Request $request)
    {
//        dd($request->all());
        $request->validate([
            'name' => 'required|max:255',
            'phone' => 'nullable|string',
            'address' => 'nullable|string',
            'email' => 'nullable|email|max:255|unique:providers',
            'employee_name' => 'required|max:255',
            'employee_phone' => 'nullable|string',
            'employee_title' => 'nullable|string',
            'employee_email' => 'nullable|email|max:255',

        ]);
        $provider = Provider::create($request->all());
        Alert::success('Provider '.$provider->name .' Created successfully');
        return redirect('admin/providers/all');
    }

    public function show(Provider $provider)
    {
        $orders = OrderProduct::where('provider_id',$provider->id)->whereHas('order')->get();

        return view('admin.providers.show', compact( 'provider','orders'));
    }
    public function edit(Provider $provider)
    {
        return view('admin.providers.edit', compact( 'provider'));
    }

    public function update(Request $request, Provider $provider)
    {
        $request->validate([
            'name' => 'required|max:255',
            'phone' => 'nullable|string',
            'address' => 'nullable|string',
            'email' => 'nullable|email|max:255',
            'employee_name' => 'required|max:255',
            'employee_phone' => 'nullable|string',
            'employee_title' => 'nullable|string',
            'employee_email' => 'nullable|email|max:255',

        ]);
        $provider->Update($request->all());
        Alert::success('Provider '.$provider->name .' Updated Successfully');
        return redirect('admin/providers/all');

        return redirect()->route('admin.users.all')->with('success', "User $user->name updated successfully");
    }

    public function destroy(Admin $user)
    {
        if($user->account_id){
            Alert::error(' Can`t delete User '.$user->name .' ');
        }else{
            $user->delete();
            Alert::success('User '.$user->name .' deleted successfully');
        }
        return redirect('admin/users/all');
    }
}
