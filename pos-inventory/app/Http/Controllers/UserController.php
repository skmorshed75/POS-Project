<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Mail\OTPEmail;
use App\Helper\JWTToken;
use Exception;
use Illuminate\Http\Request;

use Illuminate\View\View;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Contracts\Mail\Mailable;




class UserController extends Controller
{

    function LoginPage():View{
        return view('pages.auth.login-page');
    }

    function RegistrationPage():View{
        return view('pages.auth.registration-page');
    }

    function SendOtpPage():View{
        return view('pages.auth.send-otp-page');
    }

    function VerifyOtpPage():View{
        return view('pages.auth.verify-otp-page');
    }

    function ResetPasswordPage():View{
        return view('pages.auth.reset-pass-page');
    }

    function DashBoardPage():View{
        return view('pages.dashboard.dashboard-page');
    }

    
    function UserLogin(Request $request){
        //$res = User::where($request->input())->count();
        $count = User::where('email','=',$request->input('email'))
            ->where('password','=',$request->input('password'))
            ->count();

        if ($count == 1){
            //User Login -> Token Issue
            $token = JWTToken::createToken($request->input('email'));
            return response()->json([
                'status' => "success",
                'message' => "User Login Succesful",
                'token'=>$token
            ])->cookie('token',$token,60*24*30);

        } else {
            return response()->json([
                'message' => "Token Fail",
                'data'=>"unauthorised"
            ]);
        }
    }

    function UserRegistration(Request $request){
        return User::create($request->input());
    }

    function SendOTPToEmail(Request $request){
        $UserEmail = $request->input('email');
        $otp = rand(1000,9999);
        
        //$UserCount = User::where($request->input())->count();
        $UserCount = User::where('email','=',$UserEmail)->count();
        if($UserCount == 1){
            //Send Mail
            $resp = Mail::to($UserEmail)->send(new OTPEmail($otp));
            //Update Database
            User::where('email','=',$UserEmail)->update(['otp' => $otp]);
            //User::where($request->input())->update(['otp' => $otp]);
            return response()->json([
                'msg'=>"Success!",
                'data'=>"OTP sent to your email"
            ]);
        } else {
            return response()->json([
                'msg'=>"fail",
                'data'=>"Unauthorised Login"
            ]);
        }
    }

    function OTPVerify(Request $request){
        $UserEmail = $request->input('email');
        $otp = $request->input('otp');
        $UserCount = User::where('email','=',$UserEmail)
            ->where('otp','=',$otp)->count(); 
        
        if($UserCount==1){
            User::where('email','=',$UserEmail)->update(['otp' => '0']);
 
            $token = JWTToken::createToken($request->input('email'));            
            return response()->json([
                'msg' => "Success", 
                'data' => "OTP Verified",
                'token'=> $token
            ]);
        } else {
            return response()->json(['msg' => "Fail", 'data' => "OTP not verified"]);
        }
    }

    function ResetPassword(Request $request){

        try{
            $email = $request->header('email');
            $password = $request->input('password');
            User::where('email','=',$email)->update(['password'=>$password]);
            return response()->json([
                'msg' => "Success",
                'data' =>"Password Reset Successful"
            ]);
        }
        catch(Exception $e){
            return response()->json([
                'msg' => "Failed",
                'data' =>"Password Reset Not Successful"
            ]);
        }
        
    }

    //After Login
    function ProfileUpdate(){

    }



}
