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

    public function createCategoria(Reques $request){

    dd($request);

        $request->validate([
            "categoria" => 'required'
        ]);
    

    $categoria = Categoria::create([
        "categoria" => $request->categoria
    ]);

    return redirect("/categorias")->with([
        "mensaje" => "categoria registrada"
    ]);

    }


    public function updateCagetoria($id, Request $request){
        $categoria = Categoria::find($id);
        $categoria -> update([
            "categoria" => $request->categoria
        ]);
        $categoria->save();

        return redirect ('/categorias')->with(['mensaje'=> 'categoria actualizada']);
    }


    public function deleteCategoria($id){
        $categoria = Categoria::find($id);
        $categoria->delete();
        $categoria->save();
        return redirect('/categorias')->with(['mensaje '=>'categoria eliminada']);
    }






}
