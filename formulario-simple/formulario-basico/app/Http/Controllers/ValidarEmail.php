<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ValidarEmail extends Controller
{
    //
    public function Email(Request $request){
        $validator = $request-> validate([
            'email' => 'required|exists:users'
        ]);
        $msg["email"]=$request->input("email");
        return view("final",$msg); 
    }
}
