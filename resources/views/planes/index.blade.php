@extends('layouts.app')

@section('content')
<h2 class="text-2xl font-bold mb-4">Planes (POA)</h2>

@can('planes.create')
  <a href="{{ route('planes.create') }}"
     class="mb-3 inline-block bg-blue-600 text-black px-3 py-1 rounded">
     + Nuevo Plan
  </a>
@endcan

<table class="w-full text-sm">
  <thead>
    <tr class="bg-gray-200 text-left">
      <th class="px-2 py-1">Programa</th>
      <th class="px-2 py-1">Código</th>
      <th class="px-2 py-1">Versión</th>
      <th class="px-2 py-1">Nombre</th>
      <th class="px-2 py-1">Estado</th>
      <th class="px-2 py-1">Acciones</th>
    </tr>
  </thead>
  <tbody>
  @forelse($planes as $pl)
    <tr class="border-b">
      <td class="px-2 py-1">{{ $pl->programa->nombre }}</td>
      <td class="px-2 py-1">{{ $pl->codigo }}</td>
      <td class="px-2 py-1">{{ $pl->version }}</td>
      <td class="px-2 py-1">{{ $pl->nombre }}</td>
      <td class="px-2 py-1">
        <span class="px-2 py-0.5 rounded
              {{ $pl->estado=='activo' ? 'bg-green-200' : 'bg-red-200' }}">
          {{ $pl->estado }}
        </span>
      </td>
      <td class="px-2 py-1 space-x-1">
        @can('planes.edit')
          <a href="{{ route('planes.edit',$pl) }}" class="text-blue-600">Editar</a>
        @endcan
        @can('planes.delete')
          <form action="{{ route('planes.destroy',$pl) }}" method="POST" class="inline"
                onsubmit="return confirm('¿Eliminar?')">
            @csrf @method('DELETE')
            <button class="text-red-600">Borrar</button>
          </form>
        @endcan
      </td>
    </tr>
  @empty
    <tr><td colspan="6" class="text-center py-4">Sin registros</td></tr>
  @endforelse
  </tbody>
</table>

{{ $planes->links() }}
@endsection
