<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createClienteModal">
    Nuevo Cliente
</button>

<!-- Modal -->
<div class="modal fade" id="createClienteModal" tabindex="-1" aria-labelledby="createClienteModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      
      <form action="{{ route('clientes.create') }}" method="POST">
        @csrf

        <div class="modal-header">
          <h1 class="modal-title fs-5" id="createClienteModalLabel">Registrar Nuevo Cliente</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body text-start">
          <div class="mb-3">
            <label class="form-label font-bold">Nombre Completo</label>
            <input name="inputNombre" class="form-control" type="text" placeholder="Ej. Daniel Martínez" value="{{ old('inputNombre') }}" required>
            @error('inputNombre')
              <small class="text-danger">{{ $message }}</small>
            @enderror
          </div>

          <div class="mb-3">
            <label class="form-label font-bold">Correo Electrónico</label>
            <input name="inputEmail" class="form-control" type="email" placeholder="Ej. daniel@gmail.com" value="{{ old('inputEmail') }}" required>
            @error('inputEmail')
              <small class="text-danger">{{ $message }}</small>
            @enderror
          </div>

          {{-- Dirección --}}
          <div class="mb-3">
            <label class="form-label font-bold">Dirección</label>
            <input name="inputDireccion" class="form-control" type="text" placeholder="Ej. Av. Torreón #123" value="{{ old('inputDireccion') }}" required>
            @error('inputDireccion')
              <small class="text-danger">{{ $message }}</small>
            @enderror
          </div>

          {{-- Teléfono --}}
          <div class="mb-3">
            <label class="form-label font-bold">Teléfono</label>
            <input name="inputTelefono" class="form-control" type="text" placeholder="Ej. 8711234567" value="{{ old('inputTelefono') }}" required>
            @error('inputTelefono')
              <small class="text-danger">{{ $message }}</small>
            @enderror
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-success">Guardar Cliente</button>
        </div>

      </form>

    </div>
  </div>
</div>