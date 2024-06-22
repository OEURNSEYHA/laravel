<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\Price;
use Illuminate\Http\Request;


class ProductController extends Controller
{
    //
    public function index(){
        $products = Product::all();
        return response($products);
    }

    public function getone( $id){
        
        // $products = Product::findOrFail($id);
        $products = Product::find($id);
        // one to one;
        $price = Price::find($products -> price_id);
        // $price = DB::table('product')->select('')
        
        $products->price = $price->value_price;
        $category = $products ->getCategory;
        $products -> category = $category -> name;
        return response(['id'=> $products]);
        
    }

    public function add (Request $request){

        $products = Product::create( $request -> all());
        return response($products);
        
    }

    public function delete($id){
        
        $products = Product::find($id);
        if($products){
            $products -> delete();
            return response(['message'=>'Delete Completed']);
        }
        
    }
    
    public function update(Request $request,$id){
        
        $products = Product::find($id);
        if($products){
            $products -> update($request->all());
            return response(['message'=>'Update Completed']);
        }
        return response(['message'=>'Product Not Found']);

    }
}