<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Banners;
use App\Category;
use App\Products;

class IndexController extends Controller
{
    public function index(){
        $banners = Banners::where('status','1')->orderby('sort_order','asc')->get();
        $categories = Category::with('categories')->where(['parent_id'=>0])->get();
        $products = Products::where(['status'=>1])->get();
        return view('ecommerce.index')->with(compact('banners','categories','products'));
    }

    // public function home(){
    //     $banners = Banners::where('status','1')->orderby('sort_order','asc')->get();
    //     $categories = Category::with('categories')->where(['parent_id'=>0])->get();
    //     $products = Products::where(['status'=>1])->get();
    //     return view('ecommerce.index')->with(compact('banners','categories','products'));
    // }

    public function categories($category_id){
        $categories = Category::with('categories')->where(['parent_id'=>0])->where(['status'=>1])->get();
        $products = Products::where(['status'=>1,'category_id'=>$category_id])->get();
        $product_name = Products::where(['category_id'=>$category_id])->first();
        return view('ecommerce.category')->with(compact('categories','products','product_name'));
    }

    public function products(Request $request){
        //$banners = Banners::where('status','1')->orderby('sort_order','asc')->get();
        $categories = Category::with('categories')->where(['parent_id'=>0])->where(['status'=>1])->get();
        // echo "<pre>";print_r($categories);die;
        $products = Products::where(['status'=>1])->get(); //without pagination
        // $products = Products::where(['status'=>1])->paginate(2); // with pagination
        $product_search = $request->input('search'); //search products
        $searchProduct = Products::where('name','like','%'.$product_search.'%')->where('status',1)->get();
        // echo $searchProduct;die;
        return view('ecommerce.products')->with(compact('categories','products','product_search','searchProduct'));
    }
    // public function wishlist(Request $request){
    //     dd($request->all());
    // }
}
