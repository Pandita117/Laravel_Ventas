@props(['producto'])

<form action="{{ route('producto.delete', $producto->id) }}" method="POST" class="d-inline">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger" onclick=" return confirm('¿Deseas eliminar este producto {{ $producto->producto }}?') "    >
        
    </button>
</form>