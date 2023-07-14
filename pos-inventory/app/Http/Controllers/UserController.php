<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Mail\OTPEmail;
use App\Helper\JWTToken;
use Illuminate\Http\Request;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Contracts\Mail\Mailable;




class UserController extends Controller
{
    function UserLogin(Request $request){
        $res = User::where($request->input())->count();
        if ($res == 1){
            //Token Issue
            $token = JWTToken::createToken($request->input('email'));
            return response()->json(['msg' => "Success",'data'=>$token]);
        } else {
            return response()->json(['msg' => "Token Fail",'data'=>"Unauthorised"]);
        }
    }

    function UserRegistration(Request $request){
        return User::create($request->input());
    }

    function SendOTPToEmail(Request $request){
        $UserEmail = $request->input('email');
        $otp = rand(1000,9999);
        //dd($userEmail + $otp);
        $res = User::where($request->input())->count();
        if($res == 1){
            //Send Mail
            $resp = Mail::to($UserEmail)->send(new OTPEmail($otp));
            //Update Database
            User::where($request->input())->update(['otp' => $otp]);
            return response()->json(['msg'=>"Success!",'data'=>"OTP sent to your email"]);
        } else {
            return response()->json(['msg'=>"fail",'data'=>"Unauthorised Login"]);
        }
    }

    function OTPVerify(Request $request){
        $res = User::where($request->input())->count();
        if($res==1){
            User::where($request->input())->update(['otp' => '0']);
            return response()->json(['msg' => "Success", 'data' => "OTP Verified"]);
        } else {
            return response()->json(['msg' => "Fail", 'data' => "OTP not verified"]);
        }
    }

    function SetPassword(Request $request){
        User::where($request->input())->update(['password'=>$request->input('password')]);
        return response()->json(['msg' => "Success",'data' =>"Password Updated"]);
    }

    //After Login
    function ProfileUpdate(){

    }



}
