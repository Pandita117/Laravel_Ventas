<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Producto;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    
    public function getClientes() {
        $clientes = Cliente::all();

        return view('clientes', compact('clientes'));

    }


    public function createCliente(Request $request) {
        $request -> validate([
            'inputNombre' => 'required',
            'inputEmail'     => 'required|email|unique:clientes,email',
            'inputDireccion' => 'required',
            'inputTelefono' => 'required'

        ]);
        
        Cliente::create([
            'nombre' => $request->inputNombre,
            'email' => $request->inputEmail,
            'direccion' => $request->inputDireccion,
            'telefono' => $request->inputTelefono
        ]);

        return redirect()->route('clientes.get')->with('mensaje', 'Cliente registrado correctamente');
    }

    public function updateCliente(int $id, Request $request) {
        $request->validate([
            'inputNombre' => 'required',
            'inputEmail'     => 'required|email|unique:clientes,email,' . $id,
            'inputDireccion' => 'required',
            'inputTelefono' => 'required'
        ]);
        $cliente = Cliente::findOrFail($id);
        $cliente->update([
            'nombre'    => $request->inputNombre,
            'email'     => $request->inputEmail,
            'direccion' => $request->inputDireccion,
            'telefono'  => $request->inputTelefono,
        ]);
        return redirect()->route('clientes.get')->with('mensaje', 'Cliente actualizado correctamente');
    }

    public function deleteCliente(int $id) {
        $cliente = Cliente::findOrFail($id);
        $cliente->delete();

        return redirect()->route('clientes.get')->with('mensaje','cliente eliminado correctamente');
    }
    
}
