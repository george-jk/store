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
     * Display a listing of the images.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Image::all());
    }

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
            $image_name= head(explode('.',$image->getClientOriginalName()));
            $image_width=config('app_products.products.image.width');
            $image_height=config('app_products.products.image.height');
            $image_format=config('app_products.products.image.format');
            $image_fill=config('app_products.products.image.fill_color');

            if (!file_exists($save_path)){
                Storage::disk('uploads')->makeDirectory($request->path);
            }
            $background = InterventionImage::canvas($image_width,$image_height,$image_fill);
            $image=InterventionImage::make($image->getRealPath())->resize($image_width+20,$image_height+20,function ($canvas) {
                $canvas->aspectRatio();
                $canvas->upsize();
            });
            $background->insert($image, 'center')->encode($image_format);
            $background->save($save_path.'/'.$image_name.'.'.$image_format);

            Image::create([
                'path'=>$db_path.'/'.$image_name.'.'.$image_format,
                'description'=>last(explode('/',trim($request->path,'\/'))),
                'product_id'=>$request->product_id,
            ]);

            return response()->json(['success'=> 'Your file is submitted Successfully in '.$db_path.'/'.$image_name.'.'.$image_format]);
        } else {
            return response()->json(['error'=> 'Error uploading image!']);
        }
    }

    /**
     * Show the form for editing Images
     *
     * @param  \App\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function edit(Image $image)
    {
        return (view('images.edit'));
    }

    /**
     * Remove image file and DB record
     *
     * @param  \App\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function destroy(Image $image)
    {
        $file_path=str_replace(config('app_products.products.image.db_path'),'',$image->path);
        $storage_delete=Storage::disk('uploads')->delete($file_path);
        $db_delete=$image->delete();
        return response()->json([
            'storage deleted'=>$storage_delete,
            'database delete'=>$db_delete
        ]);
    }
}
