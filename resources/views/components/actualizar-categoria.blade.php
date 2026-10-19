


@props(['categoria'])

<div class="modal fade" id="editModal{{ $categoria->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $categoria->id }}" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      
      <form action="{{ route('categoria.update', $categoria->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="modal-header">
          <h1 class="modal-title fs-5" id="editModalLabel{{ $categoria->id }}">Editar Categoría #{{ $categoria->id }}</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body text-start">
          <div class="mb-3">
            <label for="inputCategoria{{ $categoria->id }}" class="form-label font-bold">Nombre de la Categoría</label>
            <input type="text" 
                   class="form-control" 
                   id="categoria{{ $categoria->id }}" 
                   name="categoria" 
                   value="{{ $categoria->categoria }}" 
                   required>
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-primary">Guardar cambios</button>
        </div>
      </form>

    </div>
  </div>
</div>
