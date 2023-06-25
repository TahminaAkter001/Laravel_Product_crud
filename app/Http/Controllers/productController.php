<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\product;

class productController extends Controller
{
    public function index(){
        return view('products.index');
    }
    public function create(){
        return view('products.create');
    }
    public function store(Request $request){
        //Validate data
        $request->validate([
            'name'        => 'required',
            'description' => 'required',
            'image'       => 'required|mimes:jpeg,jpg,png,gif'
        ]);

    
        //Upload image
        $imageName = time().'.'.$request->image->extension();
        $request->image->move(public_path('products'), $imageName);
        
        $product = new product;
        $product->image = $imageName;
        $product->name = $request->name;
        $product->description = $request -> description;

        $product->save();

        return back();
    }
}
