<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Categoria;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    // 1. Mostrar lista de productos
    public function getProductos()
    {
        $productos = Producto::with('categoria')->get();
        $categorias = Categoria::all();

        return view('productos', compact('productos', 'categorias'));
    }

    // 2. Registrar un nuevo producto
    public function createProducto(Request $request)
    {
        $request->validate([
            'inputProducto'     => 'required|string|max:255',
            'inputPrecio'       => 'required|numeric|min:0',
            'inputStock'        => 'required|integer|min:0',
            'inputCategoria_id' => 'required|exists:categoria,id',
        ]);

        Producto::create([
            'producto'     => $request->inputProducto,
            'precio'       => $request->inputPrecio,
            'stock'        => $request->inputStock,
            'categoria_id' => $request->inputCategoria_id,
        ]);

        return redirect()->route('productos.get')->with('mensaje', 'Producto registrado correctamente');
    }

    // 3. Mostrar la pantalla/formulario para editar
    public function editProducto(int $id)
    {
        $producto = Producto::findOrFail($id);
        $categorias = Categoria::all();

        return view('editProducto', compact('producto', 'categorias'));
    }

    // 4. Guardar los cambios de la edición
    public function updateProducto(int $id, Request $request)
    {
        $request->validate([
            'inputProducto'     => 'required|string|max:255',
            'inputPrecio'       => 'required|numeric|min:0',
            'inputStock'        => 'required|integer|min:0',
            'inputCategoria_id' => 'required|exists:categoria,id',
        ]);

        $producto = Producto::findOrFail($id);
        $producto->update([
            'producto'     => $request->inputProducto,
            'precio'       => $request->inputPrecio,
            'stock'        => $request->inputStock,
            'categoria_id' => $request->inputCategoria_id,
        ]);

        return redirect()->route('productos.get')->with('mensaje', 'Producto actualizado correctamente');
    }

    // 5. Eliminar producto
    public function deleteProducto(int $id)
    {
        $producto = Producto::findOrFail($id);
        $producto->delete();

        return redirect()->route('productos.get')->with('mensaje', 'Producto eliminado correctamente');
    }
}