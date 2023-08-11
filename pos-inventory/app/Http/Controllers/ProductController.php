<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{

    //SHOW PRODUCT PAGE
    function ProductPage():View{
        return view("pages.dashboard.product-page");
    }

   //NEW PRODUCT DATA 
    function ProductCreate(Request $request){
        $user_id = $request->header('id');

        //Prepare file name & path
        $img = $request->file('img');
        $t = time();
        $file_name = $img->getClientOriginalName();
        $img_name = "{$user_id}-{$t}-{$file_name}";
        $img_url = "uploads/{$img_name}";

        //UPLOAD File
        $img->move(public_path('uploads'),$img_name);

        //SAVE TO DATABASE
        return Product::create([
            'name'=>$request->input('name'),
            'price'=>$request->input('price'),
            'unit'=>$request->input('unit'),
            'img_url'=>$img_url,
            'category_id'=>$request->input('category_id'),
            'user_id'=>$user_id
        ]);
    }

    //SHOW PRODUCT LIST
    function ProductList(Request $request){
        $user_id = $request->header('id');
        return Product::where('user_id',$user_id)->get();
    }

    //DELETE PRODUCT
    function ProductDelete(Request $request){
        $user_id = $request->header('id');
        $Product_id = $request->input('id');
        $filePath = $request->input('file_path');
        File::delete($filePath);        
        return Product::where('user_id',$user_id)->where('id',$Product_id)->delete();
    }

    //UPDATE / EDIT PRODUCT
    function ProductUpdate(Request $request){
        $user_id = $request->header('id');
        $Product_id = $request->input('id');
        if ($request->hasFile('img')){
            //Upload New Files
            $img=$request->file('img');
            $t = time();
            $file_name = $img->getClientOriginalName();
            $img_name = "{$user_id}-{$t}-{$file_name}";
            $img_url= "uploads/{$img_name}";
            $img->move(public_path('uploads'),$img_name);

            //Delete Old File
            $filePath = $request->input('file_path');
            File::delete($filePath);
            //Update Product with Image
            return Product::where('user_id',$user_id)->where('id',$Product_id)->update([
                'name'=>$request->input('name'),
                'price' =>$request->input('price'),
                'unit' =>$request->input('unit'),
                'img_url' =>$img_url,
                'category_id' =>$request->input('category_id'),
            ]);

        } else {
            //Update Product without Image
            return Product::where('user_id',$user_id)->where('id',$Product_id)->update([
                'name'=>$request->input('name'),
                'price' =>$request->input('price'),
                'unit' =>$request->input('unit'),
                'category_id' =>$request->input('category_id')
            ]);

        }
    }


}
