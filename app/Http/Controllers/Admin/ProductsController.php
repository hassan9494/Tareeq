<?php
namespace App\Http\Controllers\Admin;
use App\CategoryProduct;
use App\Country;
use App\Http\Controllers\Controller;
use App\Models\Attribute;
use App\Models\ProductAttribute;
use App\Models\ProductVariation;
use App\Product;
use App\Provider;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use MediaUploader;
use Plank\Mediable\Media;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $products=Product::paginate(15);
       return view('admin.product.index', compact('products'));
    }
    public function status(Request $request , Product $product){
        $product->status =$request->status;
        $product->save();
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categoriesProduct=CategoryProduct::whereNull('parent_id')->get();
//        $attributes = Attribute::all();

        return view('admin.product.create',compact('categoriesProduct'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validation
        $request->validate([
            'category'=>'required|integer',
            'img.*'=>'image|mimes:jpg,png,jpeg,svg|max:3000',
        ]);
        foreach(config('locales') as $locale){
            $request->validate([
                'name_'.$locale => 'required',
                'sh_desc_'.$locale => 'required',
//                'desc_'.$locale => 'required',
            ]);
        }
        $product = new Product();
        foreach(config('locales') as $locale){
            $product->setTranslation('name', $locale,  $request->input('name_'.$locale));
            $product->setTranslation('sh_desc', $locale,  $request->input('sh_desc_'.$locale));
            $product->setTranslation('desc', $locale,  $request->input('desc_'.$locale));
        }
        //access request data
        $count =Product::max('id')+1;
        $product->slug =$request->input('name_en').' '.$count ;
        $product->product_cat_id =$request->input('category');

        $product->save();

        //************************uploade photo*******************
        $file = $request->file('img');

        if ($request->hasFile('img')) {
//            foreach ($files as $file){
                $media = MediaUploader::fromSource($file)->upload();
                $product->attachMedia($media, 'product');
//            }
        }
        $product->save();
        return redirect()->route('admin.courses.index')->with('success', "Course $product->name added successfully");


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('admin.product.show',compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product=Product::find($id);
        $categoriesProduct=CategoryProduct::all();

        return view('admin.product.edit',compact('product','categoriesProduct'));
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
        //validation
        $request->validate([
            'category'=>'required|integer',
            'img.*'=>'image|mimes:jpg,png,jpeg,svg|max:3000',
        ]);

        foreach(config('locales') as $locale){
            $request->validate([
                'name_'.$locale => 'required',
                'sh_desc_'.$locale => 'required',
//                'desc_'.$locale => 'required',
            ]);
        }

        $product =Product::find($id);

        foreach(config('locales') as $locale){
            $product->setTranslation('name', $locale,  $request->input('name_'.$locale));
            $product->setTranslation('sh_desc', $locale,  $request->input('sh_desc_'.$locale));
            $product->setTranslation('desc', $locale,  $request->input('desc_'.$locale));
        }
        //access request data
        $product->product_cat_id =$request->input('category');

        $product->save();


        //************************uploade photo*******************
        $file = $request->file('img');
        if ($request->hasFile('img')) {
//            foreach ($files as $file){

                $media = MediaUploader::fromSource($file)->upload();
                $product->attachMedia($media, 'product');

//            }
        }
        return redirect()->route('admin.courses.index')->with('success', "Course $product->name updated successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product=Product::find($id);
        $product->delete();

        return redirect()->back()->with('success','Course deleted successfully');

    }
    public function deleteImage(Media $media)
    {
        $media->delete();
        return redirect()->back()->with('success', "image removed successfully");
    }
}
