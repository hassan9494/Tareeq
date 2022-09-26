<?php

namespace App\Http\Controllers\Admin;

use App\Setting;
use App\Themes;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class ThemesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $themes=Themes::all();
        $activeTheme=setting('theme.site');
        $settings = Setting::where('key' , 'NOT LIKE', 'theme.%')->get()->map(function ($s) {
            $s->key = str_replace('general.', '', $s->key);
            return $s;
        })->pluck('value', 'key');

        return view('admin.themes.index',compact('themes','activeTheme','settings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function active(Themes $active)
    {
        setting()->set('theme.site',$active->name);
        setting()->save();
        return redirect()->back();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function visible(Request $request)
    {
//        dd($request->all());
//        foreach ($request->all() as $key => $value) {
            setting()->set('general.' . $request->name, $request->value);
//        }
        setting()->save();

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
    public function update(Request $request, $id)
    {
        //
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
