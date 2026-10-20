@props(['cliente'])

<!-- Modal -->
<div class="modal fade" id="editClienteModal{{ $cliente->id }}" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      
      <form action="{{ route('clientes.update', $cliente->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="modal-header">
          <h5 class="modal-title">Editar Cliente #{{ $cliente->id }}</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body text-start">
          <div class="mb-3">
            <label class="form-label font-bold">Nombre del Cliente</label>
            <input type="text" name="inputNombre" value="{{ $cliente->nombre }}" class="form-control" required>
          </div>

          <div class="mb-3">
            <label class="form-label font-bold">Email</label>
            <input type="email" name="inputEmail" value="{{ $cliente->email }}" class="form-control" required>
          </div>

          <div class="mb-3">
            <label class="form-label font-bold">Dirección</label>
            <input type="text" name="inputDireccion" value="{{ $cliente->direccion }}" class="form-control" required>
          </div>

          <div class="mb-3">
            <label class="form-label font-bold">Teléfono</label>
            <input type="text" name="inputTelefono" value="{{ $cliente->telefono }}" class="form-control" required>
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