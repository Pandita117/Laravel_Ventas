@props(['venta'])

@if($venta->estado !== 'confirmada')
    <form action="{{ route('ventas.destroy', $venta->id) }}" method="POST" class="d-inline">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Desea eliminar esta venta?')">
            Eliminar
        </button>
    </form>
@else
    <button class="btn btn-secondary btn-sm" disabled title="No se puede eliminar una venta confirmada">
        Bloqueado
    </button>
@endif