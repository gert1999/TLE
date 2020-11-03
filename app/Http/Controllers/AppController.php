<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

use Auth;

class AppController extends Controller
{
    // Login controller for the app
    public function login(Request $request){
        // Get the email and password value
        $loginDetails = $request->only('email', 'password');

        // attempt login with the values
        if(Auth::attempt($loginDetails)){
            return response()->json(['message' => 'login successful', 'code' => 200]);
        }else{
            return response()->json(['message' => 'wrong login details', 'code' => 501]);
        }
    }

    // Password reset function
    public function reset(Request $request){
        // Get email value
        $email = $request->only('email');

        // Ask for a reset link for the supplied email value
        Password::sendResetLink($email);

        // Return a json response to the application
        return response()->json(['message' => 'Reset password link send. Please check your email', 'code' => 200]);
    }


}
