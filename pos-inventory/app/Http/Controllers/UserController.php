<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Mail\OTPEmail;
use App\Helper\JWTToken;
use Exception;
use Illuminate\Console\View\Components\Alert;
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
                //'token'=>$token
            ],200)->cookie('token',$token,60*24*30);

        } else {
            return response()->json([
                'message' => "Token Fail",
                'data'=>"unauthorised"
            ],401);
        }
    }

    function UserRegistration(Request $request){
        //return User::create($request->input());
        // or
        try{
            User::create([
                'firstName' => $request->input('firstName'),
                'lastName' => $request->input('lastName'),
                'email' => $request->input('email'),
                'mobile' => $request->input('mobile'),
                'password'=> $request->input('password')
            ]);
            return response()->json([
                'status' => 'success',
                'message' => "User registration completed successfully"
            ],200);
        }
        catch(Exception $e){
            return response()->json([
                'status' => "failed",
                'message' => "User registration has been failed"
            ], 401);
        };
        
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
                'msg'=>"success!",
                'data'=>"4 digit OTP sent to your email"
            ],200);
        } else {
            return response()->json([
                'msg'=>"fail",
                'data'=>"Unauthorised Login"
            ],401);
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
                'msg' => "success", 
                'data' => "OTP Verified"
            ],200)->cookie('token',$token,60*60*24);
        } else {
            return response()->json(['status' => "failed", 'message' => "unauthorised"],401);
        }
    }

    function ResetPassword(Request $request){
        try{
            $email = $request->header('email');
            $password = $request->input('password');
            User::where('email','=',$email)->update(['password'=>$password]);
            //Cookie can be removed from here with delete cookie command or it will be automatically deleted by the token time ie. 60*60*24
            return response()->json([
                'status' => "success",
                'message' =>"Password Reset Successful"
            ],200);
        }
        catch(Exception $e){
            return response()->json([
                'status' => "fail",
                'message' =>"Password Reset Not Successful"
            ],401);
        }
        
    }

    //After Login
    function ProfileUpdate(){

    }

    function UserLogout(){
        return redirect('/userLogin')->cookie('token','',-1); //-1 = delete cookie
    }


}
