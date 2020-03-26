<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image as InterventionImage;
use App\Product;
use App\Image;


class ImageController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return(view('images.create',['products'=>Product::all()]));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->hasFile('imageFile')) {

            $image= $request->file('imageFile');
            $save_path=config('filesystems.disks.uploads.root').'/'.trim($request->path,'\/');
            $db_path=config('app_products.products.image.db_path').'/'.trim($request->path,'\/');
            $image_name= $image->getClientOriginalName();
            $image_width=config('app_products.products.image.width');
            $image_height=config('app_products.products.image.height');

            if (!file_exists($save_path)){
                Storage::disk('uploads')->makeDirectory($request->path);
            }
            $background = InterventionImage::canvas($image_width,$image_height);
            $image=InterventionImage::make($image->getRealPath())->resize($image_width,$image_height,function ($canvas) {
                $canvas->aspectRatio();
                $canvas->upsize();
            });
            $background->insert($image, 'center');
            $background->save($save_path.'/'.$image_name);

            Image::create([
                'path'=>$db_path.'/'.$image_name,
                'description'=>last(explode('/',trim($request->path,'\/'))),
                'product_id'=>$request->product_id,
            ]);

            return back()->with('success', 'Your file is submitted Successfully in '.$save_path.$image_name);
        } else {
            return back()->with('fail', 'Fail, No image uploaded!');
        }
    }
}
