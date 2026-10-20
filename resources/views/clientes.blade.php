<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css','resources/js/app.js'])
    <title>Clientes</title>
</head>
<body>

    <x-navbar/>
    <h1 class="text-center my-4">Clientes</h1>


    
        <div class="col-lg-10 offset-lg-1 mb-3">
            <x-create-cliente />
        </div>

        <div class="col-lg-10 offset-lg-1">
            <table class="table table-bordered align-middle">
                <thead class="table-info">
                   <tr>
                       <th>ID</th>
                       <th>Nombre</th>
                       <th>Email</th>
                       <th>Dirección</th>
                       <th>Teléfono</th>
                       <th>Acciones</th>
                   </tr>
                </thead>
                <tbody>
                @foreach ($clientes as $c)
                    <tr>
                        <td>{{ $c->id }}</td>
                        <td>{{ $c->nombre }}</td>
                        <td>{{ $c->email }}</td>
                        <td>{{ $c->direccion }}</td>
                        <td>{{ $c->telefono }}</td>
                        <td>
                            <button type="button"
                                    class="btn btn-info" 
                                    data-bs-toggle="modal"
                                    data-bs-target="#editClienteModal{{ $c->id }}">
                                Actualizar
                            </button>

                            <x-delete-cliente :cliente="$c" />

                            <x-update-cliente :cliente="$c" />
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    
</body>
</html>