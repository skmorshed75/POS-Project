<?php

namespace App\Http\Middleware;

use App\Helper\JWTToken;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TokenVerificationMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $token=$request->cookie('token');
        if($token == null){
            $token=$request->header('token'); //FOR MOBILE APPLICATION
        }
        
        $result=JWTToken::DecodeToken($token); //Verify Token
        if($result=="unauthorized"){
            return redirect("/userLogin");
            //show response in body
            /*return response()->json([
                'status' => 'failed',
                'message' => 'unauthorized'
            ], 401);
            */            
        }
        else{
            $request->headers->set('email',$result->userEmail);
            $request->headers->set('id',$result->userID);
            //$request->headers->set('id',$result->userID);
            return $next($request);
        }
    }
}
