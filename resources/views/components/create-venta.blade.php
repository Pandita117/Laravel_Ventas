@props(['clientes', 'productos'])

<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createVentaModal">
    Registrar Nueva Venta
</button>

<div class="modal fade" id="createVentaModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="{{ route('ventas.store') }}" method="POST">
        @csrf
        <div class="modal-header">
          <h5 class="modal-title">Registrar Nueva Venta</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body text-start">
          <div class="mb-3">
            <label class="form-label fw-bold">Cliente</label>
            <select name="cliente_id" class="form-select" required>
                <option value="">Seleccione un cliente</option>
                @foreach($clientes as $cli)
                    <option value="{{ $cli->id }}">{{ $cli->nombre }}</option>
                @endforeach
            </select>
          </div>

          <div class="mb-3">
            <label class="form-label fw-bold">Producto</label>
            <select name="producto_id" class="form-select" required>
                <option value="">Seleccione un producto</option>
                @foreach($productos as $prod)
                    <option value="{{ $prod->id }}">{{ $prod->producto }} - ${{ $prod->precio }} (Stock: {{ $prod->stock }})</option>
                @endforeach
            </select>
          </div>

          <div class="mb-3">
            <label class="form-label fw-bold">Cantidad</label>
            <input type="number" name="cantidad" class="form-control" min="1" value="1" required>
          </div>

          <div class="mb-3">
            <label class="form-label fw-bold">Estado Inicial</label>
            <select name="estado" class="form-select" required>
                <option value="pendiente">Pendiente</option>
                <option value="confirmada">Confirmada</option>
            </select>
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-success">Generar Venta</button>
        </div>
      </form>
    </div>
  </div>
</div>