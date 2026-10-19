<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css','resources/js/app.js'])
    <title>Categorias</title>
</head>
<body>

    <x-navbar/>
    <h1 class="text-center">Categorias</h1>
    <div class="row">
    </div>
    <div class="col">
        <x-create-categoria/>
        <div class="row mt-3"></div>
        <div class="col-lg-8 offset-lg-2">
            <table class="table table-bordered">
                <thead class="table table-info">
                   <th>id</th>
                   <th>categoria</th>
                   <th>Acciones</th>
                </thead>
                <tbody>
                @foreach ($categoria as $i )
                    <tr>
                        <td>{{ $i-> id }}</td>
                        <td>{{ $i-> categoria }}</td>
                        <td>
                            <button type="button"
                            class="btn btn-info" 
                            data-bs-toggle="modal"
                            data-bs-target="#editModal{{ $i->id }}">
                                    Actualizar</button>

                        {{-- Deleteo --}}
                        <form
                        action="{{ route('categoria.delete',$i -> id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('¿Deseas eliminar esta categoria?')">Eliminar</button>
                        </form>

                        <x-actualizar-categoria :categoria="$i"/>
                        </td>
                    </tr>
                   @endforeach
                </tbody>
            </table>
        </div>
    </div>
    

    
    
</body>


</html>