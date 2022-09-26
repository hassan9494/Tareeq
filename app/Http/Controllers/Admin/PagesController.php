<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Requests;
use Illuminate\Support\Str;
use App\Page;
use Illuminate\Http\Request;


class PagesController extends Controller
{
    public function index()
    {
        $pages = Page::all();
        return view('admin.pages.index', compact('pages'));
    }
    public function pageRequest(){
        $requests=Requests::whereNotNull('page_id')->orderBy('id', 'DESC')->get();
        foreach ($requests->where('views',0) as $request){
            $request->views =1;
            $request->save();
        }
        return view('admin.pages.requests',compact('requests'));
    }
    public function create()
    {
        $pages=Page::all();
        return view('admin.pages.create',compact('pages'));
    }

    public function store(Request $request)
    {

        $request->validate([
            'parentPage'=>'nullable'
        ]);
        foreach(config('locales') as $locale){
            $request->validate([
                'name_'.$locale => 'required',
                'content_'.$locale => 'nullable'

            ]);
        }
//dd($request->all());
        $page = new Page();
        $page->parent_id=$request->input('parentPage');

        foreach(config('locales') as $locale){
            $page->setTranslation('name', $locale,  $request->input('name_'.$locale));
            $page->setTranslation('content', $locale,  $request->input('content_'.$locale));
        }
        $page->slug = $request->input('hasLink') == 'on' ?null: Str::slug($request->input('name_en'))  ;
        $page->inNav = $request->input('inNav') == 'on' ? true : false;
        $page->inFooter = $request->input('inFooter') == 'on' ? true : false;
        $page->published = $request->input('published') == 'on' ? true : false;
        $page->hasForm = $request->input('hasForm') == 'on' ? true : false ;
        $page->published_at = $request->input('published_at');
        $page->order = Page::max('order') + 1;

        $page->save();
        return redirect()->route('admin.pages.index')->with('success', "Page $page->name created successfully");
    }

    public function edit(Page $page)
    {
        $pages=Page::all()->except($page->id);

        return view('admin.pages.edit', compact('page','pages'));
    }

    public function update(Request $request, Page $page)
    {
        $request->validate([
            'parentPage'=>'nullable'
        ]);

        foreach(config('locales') as $locale){
            $request->validate([
                'name_'.$locale => 'required',
                'content_'.$locale => 'nullable',

            ]);
        }

        foreach(config('locales') as $locale){
            $page->setTranslation('name', $locale,  $request->input('name_'.$locale));
            $page->setTranslation('content', $locale,  $request->input('content_'.$locale));
        }

        $page->slug = $request->input('hasLink') == 'on' ?null: Str::slug($request->input('name_en'))  ;
        $page->inFooter = $request->input('inFooter') == 'on' ? true : false;
        $page->inNav = $request->input('inNav') == 'on' ? true : false;
        $page->published = $request->input('published') == 'on' ? true : false;
        $page->hasForm = $request->input('hasForm') == 'on' ? true : false ;
        $page->published_at = $request->input('published_at');
        $page->parent_id=$request->input('parentPage');

        $page->save();

        return redirect()->route('admin.pages.index')->with('success', "Page $page->name updated successfully");
    }

    public function destroy(Page $page)
    {
        if ($page->children()->count()>0){
            return redirect()->back()->with('error', "Page $page->name parent so can not deleted before deleted chiled ");

        }else{
            $page->delete();
            return redirect()->route('admin.pages.index')->with('success', "Page $page->name deleted successfully");
        }
    }
}
