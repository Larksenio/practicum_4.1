@extends('layouts.app')

@section('content')
<h2 class="text-2xl font-bold mb-4">Programas</h2>

@can('programas.create')
  <a href="{{ route('programas.create') }}"
     class="mb-3 inline-block bg-blue-600 text-black px-3 py-1 rounded">
     + Nuevo Programa
  </a>
@endcan

<table class="w-full text-sm">
  <thead>
    <tr class="bg-gray-200">
      <th>Institución</th><th>Nombre</th><th>Estado</th><th>Acciones</th>
    </tr>
  </thead>
  <tbody>
  @forelse($programas as $p)
    <tr class="border-b">
      <td>{{ $p->institucion->nombre }}</td>
      <td>{{ $p->nombre }}</td>
      <td>
        <span class="px-2 py-0.5 rounded
              {{ $p->estado=='activo' ? 'bg-green-200' : 'bg-red-200' }}">
          {{ $p->estado }}
        </span>
      </td>
      <td class="space-x-1">
        @can('programas.edit')
          <a href="{{ route('programas.edit',$p) }}" class="text-blue-600">Editar</a>
        @endcan
        @can('programas.delete')
          <form action="{{ route('programas.destroy',$p) }}" method="POST" class="inline"
                onsubmit="return confirm('¿Eliminar?')">
            @csrf @method('DELETE')
            <button class="text-red-600">Borrar</button>
          </form>
        @endcan
      </td>
    </tr>
  @empty
    <tr><td colspan="4" class="text-center py-4">Sin registros</td></tr>
  @endforelse
  </tbody>
</table>

{{ $programas->links() }}
@endsection
