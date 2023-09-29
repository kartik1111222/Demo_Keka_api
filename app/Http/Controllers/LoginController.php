<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request){

        try {
            if(Auth::attempt($request->only('email', 'password'))){
                $user = Auth()->user();
                $token = auth()->user()->createToken('Token')->accessToken;
    
                return response()->json([
                    'message' => 'logged in successfully!',
                    'token' => $token
                  
                ]);
            }else{
    
                return response()->json([
                    'status' =>'error', 
                    'message' => 'Wrong credentials.'
                ],404);
            }
            // all good
        
        } catch (\Exception $e) {
        
        
            throw $e;
            // something went wrong
        }
        
        
       
    }

    public function login_details(){

        try {
            $user = Auth('api')->user();
            return response()->json(
                $user
              
            );
            // all good
        
        } catch (\Exception $e) {
        
        
            throw $e;
            // something went wrong
        }
        
        
    }

    public function logout(){
        try {
          
            $token = Auth('api')->user()->token();
            
            $token->revoke();
            return response()->json([
             'message' => 'Logout successfully!'   
            ]);
            // all good
        
        } catch (\Exception $e) {
        
        
            throw $e;
            // something went wrong
        }
    }
}
