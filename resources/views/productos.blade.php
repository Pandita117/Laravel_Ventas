<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css','resources/js/app.js'])
    <title>Productos</title>
</head>
<body>

    <x-navbar/>
    <h1 class="text-center">Productos</h1>
    <div class="row">
    </div>
    <div class="col">
        <x-create-producto :categorias="$categorias"/>
        <div class="row mt-3"></div>
        <div class="col-lg-8 offset-lg-2">
            <table class="table table-bordered">
                <thead class="table table-info">
                   <th>id</th>
                   <th>Producto</th>
                   <th>Precio</th>
                   <th>Stock</th>
                   <th>Categorias</th>
                   <th>Acciones</th>
                </thead>
                <tbody>
                @foreach ($productos as $p )
                    <tr>
                        <td>{{ $p-> id }}</td>
                        <td>{{ $p-> producto }}</td>
                        <td>{{ number_format($p->precio,2) }}</td>
                        <td>{{ $p->stock }}</td>
                        <td>{{ $p->categoria->categoria ?? 'sin categoria' }}</td>
                        <td>
                            <button type="button"
                            class="btn btn-info" 
                            data-bs-toggle="modal"
                            data-bs-target="#editModal{{ $p->id }}">
                                    Actualizar</button>

                        {{-- Deleteo --}}
                            <x-delete-producto :producto="$p"/>

                            <x-update-producto :producto="$p" :categorias="$categorias" />
                        </td>
                    </tr>
                   @endforeach
                </tbody>
            </table>
        </div>
    </div>
    

    
    
</body>


</html>