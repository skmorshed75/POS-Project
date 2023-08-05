<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Symfony\Component\Console\Logger\ConsoleLogger;

class CustomerController extends Controller
{
    //NEW CUSTOMER DATA 
    function CustomerCreate(Request $request){
        $user_id = $request->header('id');
        return Customer::create([
            'name'=>$request->input('name'),
            'email' => $request->input('email'),
            'mobile' => $request->input('mobile'),
            'user_id'=>$user_id
        ]);
    }

    //SHOW CUSTOMER LIST
    function CustomerList(Request $request){
        $user_id = $request->header('id');
        return Customer::where('user_id',$user_id)->get();
    }

    //DELETE CUSTOMER
    function CustomerDelete(Request $request){
        $user_id = $request->header('id');
        $customer_id = $request->input('id');
        return Customer::where('user_id',$user_id)->where('id',$customer_id)->delete();
    }

    //UPDATE / EDIT CUSTOMER
    function CustomerUpdate(Request $request){
        $user_id = $request->header('id');
        $customer_id = $request->input('id');
        return Customer::where('user_id',$user_id)->where('id',$customer_id)->update([
            'name'=>$request->input('name'),
            'email' =>$request->input('email'),
            'mobile' =>$request->input('mobile'),
        ]);
    }



}
    
