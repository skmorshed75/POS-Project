<?php
namespace App\Helper;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class JWTToken{
       
    public static function CreateToken($userEmail){
        $key = env('JWT_KEY');
        $payload = [
            'iss' => 'laravel-jwt',
            'iat' => time(),
            'exp' => time()+60*60, //expiration time
            //'user' => $userID
            'userEmail' => $userEmail
        ];

        return JWT::encode($payload, $key, 'HS256');
    }

    //DECODE TOKEN
    public static function DecodeToken($token){
        try{
            $key = env('JWT_KEY' );
            $decode = JWT::decode($token,new Key($key, 'HS256'));
            return $decoded->userEmail;
        }
        catch(Exception $e){
            return "Unauthorised";
        }
    }

}