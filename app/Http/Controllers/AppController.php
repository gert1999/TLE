<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Auth;

class AppController extends Controller
{
    // Login controller for the app
public function login(Request $request){
    $loginDetails = $request->only('email', 'password');

    if(Auth::attempt($loginDetails)){
        return response()->json(['message' => 'login successful', 'code' => 200]);
    }else{
        return response()->json(['message' => 'wrong login details', 'code' => 501]);
    }
}


}
