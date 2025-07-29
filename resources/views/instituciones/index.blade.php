@extends('layouts.app')

@section('content')
<h2 class="text-2xl font-bold mb-4">Listado de instituciones</h2>

<a href="{{ route('instituciones.create') }}"
   class="mb-3 inline-block bg-blue-600 text-black px-3 py-1 rounded">
   + Nueva Institución
</a>

<table class="w-full text-sm">
  <thead>
    <tr class="bg-gray-200">
      <th>Código</th><th>Nombre</th><th>Padre</th><th>Estado</th><th>Acciones</th>
    </tr>
  </thead>
  <tbody>
  @forelse($instituciones as $i)
    <tr class="border-b">
      <td>{{ $i->codigo }}</td>
      <td>{{ $i->nombre }}</td>
      <td>{{ $i->padre->nombre ?? '—' }}</td>
      <td>
        <span class="px-2 py-0.5 rounded
              {{ $i->estado=='activo' ? 'bg-green-200' : 'bg-red-200' }}">
          {{ $i->estado }}
        </span>
      </td>
      <td class="space-x-1">
        @can('instituciones.edit')
          <a href="{{ route('instituciones.edit',$i) }}" class="text-blue-600">Editar</a>
        @endcan
        @can('instituciones.delete')
          <form action="{{ route('instituciones.destroy',$i) }}" method="POST" class="inline"
                onsubmit="return confirm('¿Eliminar?')">
            @csrf @method('DELETE')
            <button class="text-red-600">Borrar</button>
          </form>
        @endcan
      </td>
    </tr>
  @empty
    <tr><td colspan="5" class="text-center py-4">Sin registros</td></tr>
  @endforelse
  </tbody>
</table>

{{ $instituciones->links() }}
@endsection
