<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Navbar Basic</title>
    <!-- CSS Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<!-- INICIO DEL NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-light bg-black">
  <div class="container-fluid">
    <!-- Logo / Marca -->
    <a class="navbar-brand text-white" href="#">Navbar</a>
    
    <!-- Botón para móviles (Hamburguesa) -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <!-- Menú colapsable -->
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto text-white">
        <li class="nav-item">
          <a class="nav-link active text-white" aria-current="page" href="{{ route('getCategorias') }}">Categorias</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white" aria-current="page" href="{{ route('productos.get') }}">Productos</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white" aria-current="page" href="{{ route('clientes.get') }}">Clientes</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white" aria-current="page" href="{{ route('ventas.index') }}">Ventas</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
<!-- JS Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
