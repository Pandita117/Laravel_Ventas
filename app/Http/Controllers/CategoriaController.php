<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;

class CategoriaController extends Controller
{
    public function getCategorias() {
        //Select * from categorias 
        $categoria = Categoria::all();
        return view('categoria',compact('categoria'));
    }

    public function createCategoria(Request $request){

        $request->validate([
            "categoria" => 'required'
        ]);
    

        Categoria::create([
            "categoria" => $request->categoria
        ]);

        return redirect()->route("getCategorias")->with([
            "mensaje" => "categoria registrada"
        ]);

    }


    public function updateCagetoria($id, Request $request){
        $categoria = Categoria::findOrFail($id);
        $categoria -> update([
            "categoria" => $request->categoria
        ]);
        $categoria->save();
        return redirect()->route ('getCategorias')->with(['mensaje'=> 'categoria actualizada']);
    }


    public function deleteCategoria($id){
        $categoria = Categoria::findOrFail($id);
        $categoria->delete();
        return redirect()->route('getCategorias')->with(['mensaje '=>'categoria eliminada']);
    }






}
