<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoriaController;

Route::get('/',function (){
    return view('welcome');
});

Route::get('/galeria', function () {
    return view('Galeria_imagenes');
});

Route::get('categoria',[CategoriaController::class,'getCategorias'])
-> name ('getCategorias');

Route::post('create/categoria',[CategoriaController::class, 'createCategorias'])
->name('categoria.create');

Route::put("update/categoria/{id}",[CategoriaController::class, 'updateCagetoria'])
->name('categoria.update');

Route::delete("delete/categoria/{id}",[CategoriaController::class, 'deleteCategoria'])
->name('categoria.delete');

//ruta para imagenes 
Route::get('/galeria', function () {
    $imagenes = [
        [
            'titulo' => 'Paisaje Natural',
            'descripcion' => 'Una hermosa vista de la naturaleza.',
            'archivo' => 'Rodeo.jpg'
        ],
        [
            'titulo' => 'Montañas',
            'descripcion' => 'Paisajes increíbles rodeados de montañas.',
            'archivo' => 'carlosjr.jpg'
        ],
        [
            'titulo' => 'Bosque',
            'descripcion' => 'Un tranquilo bosque rodeado de naturaleza.',
            'archivo' => 'Acevedoperfil.jpg'
        ],
        [
            'titulo' => 'Playa',
            'descripcion' => 'Un lugar perfecto para descansar.',
            'archivo' => 'Die lit.jpeg'
        ],
        [
            'titulo' => 'Ciudad',
            'descripcion' => 'Arquitectura moderna en una gran ciudad.',
            'archivo' => '2024-03-05_0d23a4d0b6e77.png.webp'
        ],
        [
            'titulo' => 'Aventura',
            'descripcion' => 'Explora nuevos lugares y vive nuevas experiencias.',
            'archivo' => 'Los strokes.jpg .jpg'
        ],
    ];

    return view('Galeria_imagenes', compact('imagenes'));
});
