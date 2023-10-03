<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;


class CategoryController extends Controller
{
    public function index(){
        $Category = Category::all();
        return view('admin.category.index',compact('Category'));
    }

    public function add(){
        return view('admin.category.add');
    }

    public function store(Request $request){
        $Category = new Category;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time().'.'.$ext;
            $path = 'assets/uploads/category/';
    
            // Move the original image
            $file->move(public_path($path), $filename);

            // Create a thumbnail
            /** @var \Intervention\Image\Image $image */
            $thumbnail = Image::make(public_path($path . $filename));
            $thumbnail->fit(100, 100); // Adjust the width and height as needed for your thumbnail
            $thumbnailPath = $path . 'thumbnails/' . $filename;
            File::isDirectory(public_path($path . 'thumbnails/')) or File::makeDirectory(public_path($path . 'thumbnails/'));
            $thumbnail->save(public_path($thumbnailPath));

            $Category->image = $filename;
            $Category->thumbnail = $thumbnailPath;
        }
        $Category->name = $request->name;
        $Category->slug = $request->slug;
        $Category->description = $request->description;
        $Category->status = $request->status == true ? '1':'0';
        $Category->popular = $request->popular == true ? '1':'0';
        $Category->meta_title = $request->meta_title;
        $Category->meta_description = $request->meta_description;
        $Category->meta_keyword = $request->meta_keyword;
        $Category->save();
        return redirect('/categories')->with('status', 'Category Added Successfully');
    }

    public function update(Request $request){
        $Category = Category::find($request->cat_id);
        if ($request->hasFile('image')) {
            $path = 'assets/uploads/category/'.$Category->image;
            if (File::exists($path)) {
                File::delete($path);
            }
            $thumb = 'assets/uploads/category/thumbnails/'.$Category->thumbnail;
            if (File::exists($thumb)) {
                File::delete($thumb);
            }
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time().'.'.$ext;
            $path = 'assets/uploads/category/';
    
            // Move the original image
            $file->move(public_path($path), $filename);

            // Create a thumbnail
            /** @var \Intervention\Image\Image $image */
            $thumbnail = Image::make(public_path($path . $filename));
            $thumbnail->fit(100, 100); // Adjust the width and height as needed for your thumbnail
            $thumbnailPath = $path . 'thumbnails/' . $filename;
            File::isDirectory(public_path($path . 'thumbnails/')) or File::makeDirectory(public_path($path . 'thumbnails/'));
            $thumbnail->save(public_path($thumbnailPath));

            $Category->image = $filename;
            $Category->thumbnail = $thumbnailPath;
        }
        $Category->name = $request->name;
        $Category->slug = $request->slug;
        $Category->description = $request->description;
        $Category->status = $request->status == true ? '1':'0';
        $Category->popular = $request->popular == true ? '1':'0';
        $Category->meta_title = $request->meta_title;
        $Category->meta_description = $request->meta_description;
        $Category->meta_keyword = $request->meta_keyword;
        $Category->update();
        return redirect('/categories')->with('status', 'Category Updated Successfully');
    }

    public function delete($id){
        $Category = Category::find($id);
    
        if (!$Category) {
            return response()->json(['success' => false, 'message' => 'Category not found.']);
        }
    
        if ($Category->image) {
            $path = 'assets/uploads/category/'.$Category->image;
            if (File::exists($path)) {
                File::delete($path);
            }
        }
        $thumb = 'assets/uploads/product/thumbnails'.$Category->thumbnail;
        if (File::exists($thumb)) {
            File::delete($thumb);
        }
    
        if ($Category->delete()) {
            return response()->json(['success' => true, 'message' => 'Category has been deleted.']);
        } else {
            return response()->json(['success' => false, 'message' => 'Category deletion failed.']);
        }
    }
}
