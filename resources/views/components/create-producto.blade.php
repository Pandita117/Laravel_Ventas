<!-- Botón para abrir el Modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createProductoModal">
    Nuevo producto
</button>

<!-- Modal -->
<div class="modal fade" id="createProductoModal" tabindex="-1" aria-labelledby="createProductoModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      
      <form action="{{ route('producto.create') }}" method="POST">
        @csrf

        <div class="modal-header">
          <h1 class="modal-title fs-5" id="createProductoModalLabel">Registrar Nuevo Producto</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body text-start">
          {{-- Nombre del Producto --}}
          <div class="mb-3">
            <label class="form-label font-bold">Nombre del Producto</label>
            <input name="inputProducto" class="form-control" type="text" placeholder="Ej. Lapicero azul" value="{{ old('inputProducto') }}" required>
            @error('inputProducto')
              <small class="text-danger">{{ $message }}</small>
            @enderror
          </div>

          {{-- Precio --}}
          <div class="mb-3">
            <label class="form-label font-bold">Precio</label>
            <input name="inputPrecio" class="form-control" type="number" step="0.01" placeholder="Ej. 15.50" value="{{ old('inputPrecio') }}" required>
            @error('inputPrecio')
              <small class="text-danger">{{ $message }}</small>
            @enderror
          </div>

          {{-- Stock --}}
          <div class="mb-3">
            <label class="form-label font-bold">Stock</label>
            <input name="inputStock" class="form-control" type="number" placeholder="Ej. 50" value="{{ old('inputStock') }}" required>
            @error('inputStock')
              <small class="text-danger">{{ $message }}</small>
            @enderror
          </div>

          {{-- Categoría --}}
          <div class="mb-3">
            <label class="form-label font-bold">Categoría</label>
            <select name="inputCategoria_id" class="form-select" required>
                <option value="" disabled selected>Selecciona una categoría</option>
                @foreach ($categorias as $cat)
                    <option value="{{ $cat->id }}">{{ $cat->categoria }}</option>
                @endforeach
            </select>
            @error('inputCategoria_id')
              <small class="text-danger">{{ $message }}</small>
            @enderror
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-success">Guardar Producto</button>
        </div>

      </form>

    </div>
  </div>
</div>