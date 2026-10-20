<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\VentaController;

Route::get('/', function () {
    return view('welcome');
});

// Categorías
Route::get('categoria', [CategoriaController::class, 'getCategorias'])->name('getCategorias');
Route::post('create/categoria', [CategoriaController::class, 'createCategoria'])->name('categoria.create');
Route::put("update/categoria/{id}", [CategoriaController::class, 'updateCagetoria'])->name('categoria.update');
Route::delete("delete/categoria/{id}", [CategoriaController::class, 'deleteCategoria'])->name('categoria.delete');

// Productos 
Route::get('/productos', [ProductoController::class, 'getProductos'])->name('productos.get');
Route::post('productos/create', [ProductoController::class, 'createProducto'])->name('producto.create');
Route::put('productos/update/{id}', [ProductoController::class, 'updateProducto'])->name('producto.update');
Route::delete('productos/delete/{id}', [ProductoController::class, 'deleteProducto'])->name('producto.delete');
Route::get('productos/edit/{id}', [ProductoController::class, 'editProducto'])->name('producto.edit');

// Clientes
Route::get('/clientes', [ClienteController::class, 'getClientes'])->name('clientes.get');
Route::post('/clientes/create', [ClienteController::class, 'createCliente'])->name('clientes.create');
Route::put('/clientes/update/{id}', [ClienteController::class, 'updateCliente'])->name('clientes.update');
Route::delete('/clientes/delete/{id}', [ClienteController::class, 'deleteCliente'])->name('clientes.delete');



//ventas
Route::get('/ventas', [VentaController::class, 'index'])->name('ventas.index');
Route::post('/ventas', [VentaController::class, 'store'])->name('ventas.store');
Route::put('/ventas/{id}', [VentaController::class, 'update'])->name('ventas.update');
Route::delete('/ventas/{id}', [VentaController::class, 'destroy'])->name('ventas.destroy');
// Galería de imágenes
Route::get('/galeria', function () {
    $imagenes = [
        ['titulo' => 'Paisaje Natural', 'descripcion' => 'Una hermosa vista de la naturaleza.', 'archivo' => 'Rodeo.jpg'],
        ['titulo' => 'Montañas', 'descripcion' => 'Paisajes increíbles rodeados de montañas.', 'archivo' => 'carlosjr.jpg'],
        ['titulo' => 'Bosque', 'descripcion' => 'Un tranquilo bosque rodeado de naturaleza.', 'archivo' => 'Acevedoperfil.jpg'],
        ['titulo' => 'Playa', 'descripcion' => 'Un lugar perfecto para descansar.', 'archivo' => 'Die lit.jpeg'],
        ['titulo' => 'Ciudad', 'descripcion' => 'Arquitectura moderna en una gran ciudad.', 'archivo' => '2024-03-05_0d23a4d0b6e77.png.webp'],
        ['titulo' => 'Aventura', 'descripcion' => 'Explora nuevos lugares y vive nuevas experiencias.', 'archivo' => 'Los strokes.jpg .jpg'],
    ];

    return view('Galeria_imagenes', compact('imagenes'));
});