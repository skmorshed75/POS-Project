<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\View\View;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //SHOW CATEGORY PAGE
    function CategoryPage():View{
        return view("pages.dashboard.category-page");
    }

    //NEW Category DATA 
    function CategoryCreate(Request $request){
        $user_id = $request->header('id');
        return Category::create([
            'name'=>$request->input('name'),
            'user_id'=>$user_id
        ]);
    }

    //SHOW Category LIST
    function CategoryList(Request $request){
        $user_id = $request->header('id');
        return Category::where('user_id',$user_id)->get();  
    }

    //DELETE Category
    function CategoryDelete(Request $request){
        $user_id = $request->header('id');
        $category_id = $request->input('id');
        return Category::where('user_id',$user_id)->where('id',$category_id)->delete();
    }

    //UPDATE / EDIT Category
    function CategoryUpdate(Request $request){
        $user_id = $request->header('id');
        $category_id = $request->input('id');
        return Category::where('user_id',$user_id)->where('id',$category_id)->update([
            'name'=>$request->input('name'),
        ]);
    }
}
