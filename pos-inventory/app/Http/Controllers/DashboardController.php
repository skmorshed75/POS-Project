<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Customer;
use Illuminate\View\View;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    function DashboardPage():View{
        return view('pages.dashboard.dashboard-page');
    }

    function TotalCustomer(Request $request){
        $id = $request->header('id');
        return Customer::where('user_id', $id)->count();
    }

    function TotalCategory(Request $request){
        $id = $request->header('id');
        return Category::where('user_id', $id)->count();
    }

    //TOTAL PRODUCT
    function TotalProduct(Request $request){
        $id = $request->header('id');
        return Product::where('user_id', $id)->count();
    }
}
