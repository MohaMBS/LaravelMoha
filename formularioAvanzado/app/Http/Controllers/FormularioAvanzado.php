<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FormularioAvanzado extends Controller
{
    //

    public function Encuesta(Request $request){
        $msg=[];
        $validator = $request-> validate([
            'email' => 'required|exists:users',
            'nif' =>'required|regex:/^[0-9]{8}[TRWAGMYFPDXBNJZSQVHLCKE]$/i',
            'archivo'=>'required|file|max:1024',
            "foto"  => "required|image|mimes:jpeg,png,jpg,gif,svg|dimensions:min_width=1920,min_height=1080"
        ]);

        $fileA = $request->file('archivo');
        $fileF = $request->file('foto');
        
        $nameA = time().$fileA->getClientOriginalName();
        $nameF = time().$fileF->getClientOriginalName();
        
        $fileF->move(public_path().'/img/',$nameF);
        $fileA->move(public_path().'/img/',$nameA);
        
        $msg["email"]=$request->input("email");
        $msg["nif"]=$request->input("nif");
        $msg["foto"]=$nameF;
        $msg["archivo"]=$nameA;
        
        return view("final",$msg);
    }
}
/*/^[XYZ][0-9]{7}[TRWAGMYFPDXBNJZSQVHLCKE]$/i        */