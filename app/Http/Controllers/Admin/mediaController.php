<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\DB;
use MediaUploader;
use Plank\Mediable\Media;
use Plank\Mediable\Mediable;

class mediaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $media = Media::orderBy('id', 'desc')->paginate(50);
        return view('admin.media.index', compact('media'));
    }

    public function more(Request $request, $page)
    {
        $output = '';
        Input::merge(array("page" => $page));
        $media = Media::orderBy('id', 'desc')->paginate(9);
        if (!$media->isEmpty()) {
            foreach ($media as $file) {
                $output .= '<div class="col-md-4">
                                <figure>
                                    <img src="' . $file->getUrl() . '"
                                         alt=""/>';
                if (Auth::user()->can('delete media')) {
                    $output .= '<span class="delete-figure">
                                <a href="' . route('admin.media.delete', $file) . '" class="btn btn-sm delete">
                                    <i class="icon-trash text-danger"></i>
                                </a>
                            </span>';
                }
                $output .= '<figcaption>'
                    . _('Name') . ': ' . $file->filename . ' ' . _('Size') . ': ' . HumanReadable::bytesToHuman($file->size) . '
                            </figcaption>
                            <div class="selected" data-id="' . $file->id . '" data-selected="false">
                                <i class="icon-check"></i>
                            </div></figure> </div>';
            }
        }
        return [
            'data' => $output,
            'page' => $page
        ];
    }

    public function store(Request $request)
    {
//        $media = MediaUploader::fromSource($request->file('img'))
//            ->upload();
//        return $media->filename;
        $files = $request->file('img');
        if ($request->hasFile('img')) {
            foreach ($files as $file){
                $media = MediaUploader::fromSource($file)->upload();
            }
        }
        return redirect()->back();
    }

    public function destroy(Media $media)
    {
        $count =  DB::table('mediables')->where('media_id',$media->id)->count();
        if($count < 1 ){
            $media->delete();
            return redirect()->back()->with('success','Done');
        }else{
            return redirect()->back()->with('error','can`t delete this image');
        }

    }

}
