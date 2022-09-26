<?php

namespace App\Http\Controllers\Admin;
use App\Admin;
use App\Http\Controllers\Controller;
use App\Setting;
use Illuminate\Contracts\Cache\Factory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;


class SettingsController extends Controller
{
    public function edit()
    {
        $settings = Setting::where('key' , 'NOT LIKE', 'theme.%')->get()->map(function ($s) {
            $s->key = str_replace('general.', '', $s->key);
            return $s;
        })->pluck('value', 'key');

        return view('admin.settings.edit', compact('settings'));
    }

    public function update(Request $request, Factory $cache)
    {
        $cache->forget('settings');

        $fields = $request->all();

        $skip_keys = ['_method', '_token'];
        $file_keys = ['logo'];

        foreach ($fields as $key => $value) {

            // Don't process unwanted keys
            if (in_array($key, $skip_keys)) {
                continue;
            }

            // Process file uploads
            if (in_array($key, $file_keys)) {
                // Upload attachment
//                dd(!empty($value));
                if ($request->file($key) && !empty($value)) {
//                    Storage::delete('public/' . setting('general.logo'));
                    $filename = $request->file($key)->getClientOriginalName();
                    $location = public_path('logo/');
                    $request->file($key)->move($location, $filename);
                    $value = $filename;
//                    dd(Storage::get('public/'.$filename));
                }
            }

            // Prevent reset
            if (empty($value)) {
                continue;
            }
            setting()->set('general.' . $key, $value);
        }
        // Save all settings
        setting()->save();

        return redirect()->back()->with('success', "Settings Saved successfully");
    }
    public function editProfile(Request $request){
        $admin=Auth::guard('admin')->user();
        return view('admin.profile',compact('admin'));

    }
    public function updateProfile(Request $request){
        // dd(Hash::make($request->oldPassword) );

        $request->validate([
            'name'       =>     'min:3',
            'email'          =>'required|email',
            'oldPassword'=>'string|nullable',
            'newPassword'=>'nullable|string|confirmed'
        ]);
        $admin=Auth::guard('admin')->user();
        $admin->name=$request->input('name');
        $admin->email=$request->input('email');
         // dd(Hash::check($request->oldPassword,$admin->password));
        if ($request->oldPassword) {
            if (Hash::check($request->oldPassword,$admin->password)){
            $admin->password = Hash::make($request->newPassword);
            }else{
                return redirect()->back()->with('error','invalid old Password ');
            }
        }

        $admin->save();
        return redirect('admin/profile')->with('success','update successfully');
   }


}
