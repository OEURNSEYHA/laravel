<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public $prodcut = [];
    public $perPage = 5;
    //
    public function index(Request $request) {
        // $products = Product::orderby('id','desc')->get(); 
        $keyword = $request -> get('search');
        $this -> perPage = 5 ;
        
        // $mySelectValue = request()->input('my_select');

        if(!empty($keyword)){
            $products = Product::where('name', 'LIKE', "%$keyword%")
            ->orWhere('category','LIKE', "%$keyword%")
            ->latest() -> paginate($this->perPage);
        }else{
            $products = Product::latest()-> paginate($this->perPage);
        }
        return view('products.index', ['products'=>$products])-> with('i', (request()->input('page',1)-1)*5);
    } 

    public function getDataPerPage($number){
        if(!empty($keyword)){
            $products = Product::where('name', 'LIKE', "%$keyword%")
            ->orWhere('category','LIKE', "%$keyword%")
            ->latest() -> paginate($number);
        }else{
            $products = Product::latest()-> paginate($number);
        }
        return view('products.index', ['products'=>$products])-> with('i', (request()->input('page',1)-1)*5);
    }

    public function create(){
        return view('products.create');
    }

    public function store(Request $request){
        
        $request -> validate([
            'name' => 'required',
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2028'
        ]);
        
        $prodcut = new Product;
        $prodcut -> name = $request -> name;
        $prodcut -> description = $request -> description;
        $prodcut -> category = $request -> category;
        $prodcut -> quantity = $request -> quantity;
        $prodcut -> price = $request -> price;
        $file_name = time(). '.' . request()->image->getClientOriginalExtension();
        request()->image->move(public_path('images'), $file_name);
        $prodcut -> image = $file_name;
        
        $prodcut->save();
        return redirect()->route('products.index')->with('success','Product Add success');
    }


    public function edit($id){
        
        $product = Product::findOrFail($id);
        return view('products.edit',['product' => $product]);
        
    }
    
    public function update(Request $request){
        $request->validate([
            'name'=>'required'
        ]);
        
       

        $file_name = $request->hidden_image ;
        if($request -> image !=''){
            $file_name = time(). '.' . request()->image->getClientOriginalExtension();
            request()->image->move(public_path('images'), $file_name);
        }

        $prodcut = Product::find($request->hidden_id);
        $prodcut -> name = $request -> name;
        $prodcut -> description = $request -> description;
        $prodcut -> category = $request -> category;
        $prodcut -> quantity = $request -> quantity;
        $prodcut -> price = $request -> price;
        $prodcut -> image = $file_name;
        
        // $image_path = public_path()."/images/";
        // $image = $image_path. $prodcut->image;
        // if(file_exists($image)){
        //     @unlink($image);
        // }
        
        $prodcut->save();
        return redirect()->route('products.index')->with('success','Product update successfully'); 
    }



    public function destroy($id){
        $prodcut = Product::findOrFail($id);
        $image_path = public_path()."/images/";
        $image = $image_path. $prodcut->image;
        if(file_exists($image)){
            @unlink($image);
        }
        $prodcut->delete();
        return redirect('products')->with('success','Product Deleted');
    }
}