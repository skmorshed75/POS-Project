<?php
namespace App\Helper;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class JWTToken{
       
    public static function CreateToken($userEmail, $userID){
        $key = env('JWT_KEY');
        $payload = [
            'iss' => 'laravel-jwt',
            'iat' => time(),
            'exp' => time()+60*60, //expiration time            
            'userEmail' => $userEmail,
            'userID' => $userID
        ];

        return JWT::encode($payload, $key, 'HS256');
    }
    
    //CREATE TOKEN FOR PASSWORD CHANGE
    public static function CreateTokenForSetPass($userEmail){
        $key = env('JWT_KEY');
        $payload = [
            'iss' => 'laravel-jwt',
            'iat' => time(),
            'exp' => time()+60*60, //expiration time
            'userEmail' => $userEmail,
            'userID' => "0"
        ];

        return JWT::encode($payload, $key, 'HS256');
    }

    //DECODE / VERIFY TOKEN
    public static function DecodeToken($token):object|string{
        try{
            if($token == null) {
                return "unauthorized";
            }
            else {
                $key = env('JWT_KEY' );
                $decode = JWT::decode($token,new Key($key, 'HS256'));
                return $decode; //all data from decode variable
                //return $decode->userEmail;
            }
        }
        catch(Exception $e){    
            return "unauthorized";
        }
    }

}