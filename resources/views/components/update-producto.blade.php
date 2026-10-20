@props(['producto', 'categorias'])

<!-- Modal -->
<div class="modal fade" id="editModal{{ $producto->id }}" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      
      <form action="{{ route('producto.update', $producto->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="modal-header">
          <h5 class="modal-title">Editar Producto #{{ $producto->id }}</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body text-start">
          <div class="mb-3">
            <label class="form-label font-bold">Nombre del Producto</label>
            <input type="text" name="inputProducto" value="{{ $producto->producto }}" class="form-control" required>
          </div>

          <div class="mb-3">
            <label class="form-label font-bold">Precio</label>
            <input type="number" step="0.01" name="inputPrecio" value="{{ $producto->precio }}" class="form-control" required>
          </div>

          <div class="mb-3">
            <label class="form-label font-bold">Stock</label>
            <input type="number" name="inputStock" value="{{ $producto->stock }}" class="form-control" required>
          </div>

          <div class="mb-3">
            <label class="form-label font-bold">Categoría</label>
            <select name="inputCategoria_id" class="form-select" required>
                @foreach ($categorias as $cat)
                    <option value="{{ $cat->id }}" @selected($producto->categoria_id == $cat->id)>
                        {{ $cat->categoria }}
                    </option>
                @endforeach
            </select>
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-primary">Guardar Cambios</button>
        </div>

      </form>

    </div>
  </div>
</div>