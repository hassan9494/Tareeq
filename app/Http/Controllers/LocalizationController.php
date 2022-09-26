<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\App;
use Illuminate\Routing\Controller as BaseController;

class LocalizationController extends BaseController
{
    public function index($locale)
    {
//        dd($locale);
        App::setLocale($locale);
        session()->put('locale', $locale);
        return redirect()->back();
    }
}
