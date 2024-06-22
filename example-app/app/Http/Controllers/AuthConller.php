<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;

class AuthConller extends Controller
{
    //

    public function login(Request $request){
        if(!$request -> email && !$request -> password){
            return(response(['message'=> 'Please Input email and password']));
        }

        $user = User::where('email', $request->email)->first();
        if($user){
            
            if($user -> password == $request -> password){
                $access_token =  $user-> createToken('authToken')->plainTextToken;
                return response(['user'=>$user, 'access_token'=>$access_token]);
            }
            // return(response(['message'=> 'Login Success']));
            
        }
        
        return response([ 'message' => 'Not found']);
        
    }
}