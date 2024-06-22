<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    
    public function alluser(){
        
        $users = User::all();
        return response($users);
        
    }

    public function oneuser($id){

        return response(['id'=> $id]);
        
    }

    public function adduser (Request $request){
        
        $users = User::create( $request -> all());
        return response($users);
        
    }
    
}