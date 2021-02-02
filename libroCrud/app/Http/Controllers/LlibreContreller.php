<?php

namespace App\Http\Controllers;
use App\Models\Llibre;
use Illuminate\Http\Request;

class LlibreContreller extends Controller
{
    //

    public function index(){
        $data["llibres"]=Llibre::all();
        return view("llibre.llibresVer",$data);
    }

    public function addNew(){
        return view("llibre.llibresAdd");
    }

    public function store(Request $request)
    {
        $dataV = $request->validate([
            'nombre'=>'required|max:255',
            'resumen'=>'required|max:255',
            'npagina'=>'required|max:255',
            'edicion'=>'required|max:255',
            'autor'=>'required|max:255',
            'precio'=>'required|max:255',
        ]);
        $llibre = new Llibre;
        $llibre->nombre = $request->nombre;
        $llibre->resumen = $request->resumen;
        $llibre->npagina = $request->npagina;
        $llibre->edicion = $request->edicion;
        $llibre->autor = $request->autor;
        $llibre->precio = $request->precio;
        $llibre->save();
        return redirect("llibres");
    }

    public function destroy($id){
        Llibre::destroy($id);
        return redirect("llibres");
    }

    public function ediLlibre($id)
    {
        $data["llibre"]=Llibre::find($id);
        return view("llibre.llibresEdit",$data);
    }

    public function save(Request $request){
        $dataV = $request->validate([
            'id'=>'exists:llibres',
            'nombre'=>'required|max:255',
            'resumen'=>'required|max:255',
            'npagina'=>'required|max:255',
            'edicion'=>'required|max:255',
            'autor'=>'required|max:255',
            'precio'=>'required|max:255',
        ]);
        $llibre = Llibre::find($request->id);
        $llibre->nombre=$request->nombre;
        $llibre->resumen=$request->resumen;
        $llibre->npagina=$request->npagina;
        $llibre->edicion=$request->edicion;
        $llibre->autor=$request->autor;
        $llibre->precio=$request->precio;
        $llibre->save();
        return redirect("llibres");
    }
}
