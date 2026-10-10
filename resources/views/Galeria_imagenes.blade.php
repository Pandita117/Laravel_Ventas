<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>Galeria de Imagenes</title>
</head>
<body class="bg-gray-100">
    <!-- Este es el cabezon de la peish -->
<header class=" bg-blue-950 text-white">
    <div class="container mx-auto flex justify-between p-4 items-center">
        <span class="font-semibold text-2xl">Galeria</span>
        <nav class="space-x-6">
            <a href="#" class=" hover:text-gray-400">Inicio</a>
            <a href="#" class=" hover:text-gray-400">Galeria</a>
            <a href="#" class=" hover:text-gray-400">Nosotros</a>
            <a href="#" class=" hover:text-gray-400">Contacto</a>
        </nav>
    </div>
</header>
<main class="container mx-auto p-6  min-h-screen">
        <h1 class="text-4xl font-bold text-gray-800 text-center my-8">Nuestra Galería</h1>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($imagenes as $imagen)
                <div class="bg-white rounded-2xl shadow-md overflow-hidden">
                    <img src="{{ asset('Imagenes/' . $imagen['archivo']) }}" 
                         alt="{{ $imagen['titulo'] }}" 
                         class="w-full h-60 object-cover">
                    <div class="p-4">
                        <h3 class="font-bold text-gray-900 text-lg">{{ $imagen['titulo'] }}</h3>
                        <p class="text-gray-600 text-sm mt-2">{{ $imagen['descripcion'] }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </main>
    
</body>
</html>