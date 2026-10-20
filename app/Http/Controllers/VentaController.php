<?php

namespace App\Http\Controllers;

use App\Models\Venta;
use App\Models\DetalleVenta;
use App\Models\Cliente;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VentaController extends Controller
{
    public function index()
    {
        $ventas = Venta::with(['cliente', 'detalles.producto'])->orderBy('id', 'desc')->get();
        $clientes = Cliente::all();
        $productos = Producto::where('stock', '>', 0)->get();

        return view('ventas', compact('ventas', 'clientes', 'productos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'cliente_id'  => 'required|exists:clientes,id',
            'producto_id' => 'required|exists:productos,id',
            'cantidad'    => 'required|integer|min:1',
            'estado'      => 'required|in:pendiente,confirmada,cancelada',
        ]);

        $producto = Producto::findOrFail($request->producto_id);

        // Validar Stock
        if ($producto->stock < $request->cantidad) {
            return redirect()->back()->withErrors(['stock' => 'Stock insuficiente. Disponibles: ' . $producto->stock]);
        }

        DB::transaction(function () use ($request, $producto) {
            $totalVenta = $producto->precio * $request->cantidad;

            $venta = Venta::create([
                'cliente_id'  => $request->cliente_id,
                'fecha_venta' => now(),
                'estado'      => $request->estado,
                'total'       => $totalVenta,
            ]);

            DetalleVenta::create([
                'venta_id'        => $venta->id,
                'producto_id'     => $producto->id,
                'cantidad'        => $request->cantidad,
                'precio_unitario' => $producto->precio,
                'total'           => $totalVenta,
            ]);

            $producto->decrement('stock', $request->cantidad);
        });

        return redirect()->route('ventas.index')->with('mensaje', 'Venta registrada exitosamente.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'estado' => 'required|in:pendiente,confirmada,cancelada',
        ]);

        $venta = Venta::findOrFail($id);
        $venta->update(['estado' => $request->estado]);

        return redirect()->route('ventas.index')->with('mensaje', 'Estado de venta actualizado correctamente.');
    }

    public function destroy($id)
    {
        $venta = Venta::findOrFail($id);

        if ($venta->estado === 'confirmada') {
            return redirect()->back()->withErrors(['error' => 'No se pueden eliminar ventas que estén confirmadas.']);
        }

        $venta->delete();

        return redirect()->route('ventas.index')->with('mensaje', 'Venta eliminada correctamente.');
    }
}