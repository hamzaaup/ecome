<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Product = Product::all();
        $Category = Category::all();
        return view('admin.Product.index',compact('Product','Category'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $Category = Category::all();
        return view('admin.Product.add',compact('Category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $Product = new Product;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time() . '.' . $ext;
            $path = 'assets/uploads/product/';
    
            // Move the original image
            $file->move(public_path($path), $filename);

            // Create a thumbnail
            /** @var \Intervention\Image\Image $image */
            $thumbnail = Image::make(public_path($path . $filename));
            $thumbnail->fit(100, 100); // Adjust the width and height as needed for your thumbnail
            $thumbnailPath = $path . 'thumbnails/' . $filename;
            File::isDirectory(public_path($path . 'thumbnails/')) or File::makeDirectory(public_path($path . 'thumbnails/'));
            $thumbnail->save(public_path($thumbnailPath));

            $Product->image = $filename;
            $Product->thumbnail = $thumbnailPath;
        }
        $Product->category_id = $request->category_id;
        $Product->name = $request->name;
        $Product->slug = $request->slug;
        $Product->small_description = $request->small_description;
        $Product->description = $request->description;
        $Product->original_price = $request->original_price;
        $Product->selling_price = $request->selling_price;
        $Product->quantity = $request->quantity;
        $Product->tax = $request->tax;
        $Product->status = $request->status == true ? '1':'0';
        $Product->trending = $request->trending == true ? '1':'0';
        $Product->meta_title = $request->meta_title;
        $Product->meta_description = $request->meta_description;
        $Product->meta_keyword = $request->meta_keyword;
        $Product->save();
        return redirect('/products')->with('status', 'Product Added Successfully');
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
    public function update(Request $request)
    {
        $Product = Product::find($request->product_id);
        if ($request->hasFile('image')) {
            $path = 'assets/uploads/product/'.$Product->image;
            if (File::exists($path)) {
                File::delete($path);
            }
            $thumb = 'assets/uploads/product/thumbnails/'.$Product->thumbnail;
            if (File::exists($thumb)) {
                File::delete($thumb);
            }

            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time() . '.' . $ext;
            $path = 'assets/uploads/product/';
    
            // Move the original image
            $file->move(public_path($path), $filename);

            // Create a thumbnail
            /** @var \Intervention\Image\Image $image */
            $thumbnail = Image::make(public_path($path . $filename));
            $thumbnail->fit(100, 100); // Adjust the width and height as needed for your thumbnail
            $thumbnailPath = $path . 'thumbnails/' . $filename;
            File::isDirectory(public_path($path . 'thumbnails/')) or File::makeDirectory(public_path($path . 'thumbnails/'));
            $thumbnail->save(public_path($thumbnailPath));

            $Product->image = $filename;
            $Product->thumbnail = $thumbnailPath;
        }
        $Product->category_id = $request->category_id;
        $Product->name = $request->name;
        $Product->slug = $request->slug;
        $Product->small_description = $request->small_description;
        $Product->description = $request->description;
        $Product->original_price = $request->original_price;
        $Product->selling_price = $request->selling_price;
        $Product->quantity = $request->quantity;
        $Product->tax = $request->tax;
        $Product->status = $request->status == true ? '1':'0';
        $Product->trending = $request->trending == true ? '1':'0';
        $Product->meta_title = $request->meta_title;
        $Product->meta_description = $request->meta_description;
        $Product->meta_keyword = $request->meta_keyword;
        $Product->update();
        return redirect('/products')->with('status', 'Product Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Product = Product::find($id);
    
        if (!$Product) {
            return response()->json(['success' => false, 'message' => 'Product not found.']);
        }
    
        if ($Product->image) {
            $path = 'assets/uploads/product/'.$Product->image;
            if (File::exists($path)) {
                File::delete($path);
            }
            $thumb = 'assets/uploads/product/thumbnails'.$Product->thumbnail;
            if (File::exists($thumb)) {
                File::delete($thumb);
            }
        }
    
        if ($Product->delete()) {
            return response()->json(['success' => true, 'message' => 'Product has been deleted.']);
        } else {
            return response()->json(['success' => false, 'message' => 'Product deletion failed.']);
        }
    }
}
