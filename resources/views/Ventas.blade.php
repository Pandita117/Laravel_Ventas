<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css','resources/js/app.js'])
    <title>Ventas</title>
</head>
<body>

    <x-navbar/>
    <h1 class="text-center my-4">Administración de Ventas</h1>

    <div class="container">
        @if(session('mensaje'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('mensaje') }}
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="col-lg-10 offset-lg-1 mb-3">
            <x-create-venta :clientes="$clientes" :productos="$productos" />
        </div>

        <div class="col-lg-10 offset-lg-1">
            <table class="table table-bordered align-middle text-center">
                <thead class="table-info">
                   <tr>
                       <th>ID</th>
                       <th>Cliente</th>
                       <th>Fecha</th>
                       <th>Estado</th>
                       <th>Total</th>
                       <th>Acciones</th>
                   </tr>
                </thead>
                <tbody>
                @foreach ($ventas as $v)
                    <tr>
                        <td>{{ $v->id }}</td>
                        <td>{{ $v->cliente->nombre ?? 'N/A' }}</td>
                        <td>{{ $v->fecha_venta }}</td>
                        <td>
                            <span class="badge 
                                {{ $v->estado == 'confirmada' ? 'bg-success' : ($v->estado == 'pendiente' ? 'bg-warning' : 'bg-danger') }}">
                                {{ ucfirst($v->estado) }}
                            </span>
                        </td>
                        <td>${{ number_format($v->total, 2) }}</td>
                        <td>
                            <button type="button" 
                                    class="btn btn-info btn-sm" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#editVentaModal{{ $v->id }}">
                                Cambiar Estado
                            </button>

                            <x-delete-venta :venta="$v" />

                            <x-update-venta :venta="$v" />
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    
</body>
</html>