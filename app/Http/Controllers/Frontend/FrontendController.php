<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class FrontendController extends Controller
{
    public function index(){
        $products = Product::where('trending', '1')->where('status', '1')->take('8')->get();
        $popular_category = Category::where('popular', '1')->where('status', '1')->take('8')->get();
        return view('frontend.index', compact('products','popular_category'));
    }

    public function category(){
        $active_category = Category::where('status', '1')->get();
        return view('frontend.category', compact('active_category'));
    }
    
    public function view_category($slug){
        if(category::where('slug', '=', $slug)->where('status', '1')->exists()) {
            $active_category = Category::where('status', '1')->where('slug', $slug)->first();
            $products = Product::where('category_id', $active_category->id)->get();
            return view('frontend.products.index', compact('active_category','products'));
        }else{
            return redirect('/category')->with('message', 'Link Not Found...!');
        }
    }
    
    public function view_product($category_slug, $product_slug){
        if(category::where('slug', '=', $category_slug)->where('status', '1')->exists() && Product::where('slug', '=', $product_slug)->exists()) {
            $active_category = Category::where('status', '1')->where('slug', $category_slug)->first();
            $product = Product::where('category_id', $active_category->id)->where('slug', $product_slug)->first();
            return view('frontend.products.product-view', compact('active_category','product'));
        }else{
            return redirect('/category')->with('message', 'Link Not Found...!');
        }
    }
}
