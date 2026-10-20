@props(['cliente'])

<form action="{{ route('clientes.delete', $cliente->id) }}" method="POST" class="d-inline">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger" onclick=" return confirm('¿Deseas eliminar este cliente {{ $cliente->cliente }}?') "    >
        
    </button>
</form>