@extends('layouts.app')

@section('title','Usuarios')

@section('content')
<div class="max-w-6xl mx-auto py-8">

  <div class="flex items-center justify-between mb-4">
    <h1 class="text-xl font-semibold text-gray-900">Listado de usuarios</h1>

    {{-- Mostrar siempre (luego volvemos a poner permisos) --}}
    <a href="{{ route('usuarios.create') }}" class="btn-primary">
      + Nuevo usuario
    </a>
  </div>

  <div class="overflow-x-auto bg-white border border-gray-200 rounded-xl shadow-sm">
    <table class="min-w-full text-sm">
      <thead class="table-header">
        <tr>
          <th class="px-4 py-2 text-left w-16">ID</th>
          <th class="px-4 py-2 text-left">Nombre</th>
          <th class="px-4 py-2 text-left">Email</th>
          <th class="px-4 py-2 text-left w-64">Rol</th>
          <th class="px-4 py-2 text-right w-32">Acciones</th>
        </tr>
      </thead>

      <tbody>
        @forelse ($usuarios as $u)
          <tr class="table-row">
            <td class="px-4 py-2 font-mono text-xs text-gray-700">{{ $u->id }}</td>
            <td class="px-4 py-2 text-gray-800">{{ $u->name }}</td>
            <td class="px-4 py-2 text-gray-700">{{ $u->email }}</td>

            <td class="px-4 py-2">
              @php($roles = $u->roles->pluck('name'))
              @if($roles->isEmpty())
                <span class="text-xs text-gray-500">—</span>
              @else
                <div class="flex flex-wrap gap-2">
                  @foreach($roles as $rol)
                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-700">
                      {{ $rol }}
                    </span>
                  @endforeach
                </div>
              @endif
            </td>

            <td class="px-4 py-2 text-right">
              <div class="inline-flex items-center gap-3">

                {{-- Editar (ícono) --}}
                <a href="{{ route('usuarios.edit', $u) }}"
   class="btn-icon btn-edit"
   title="Editar">
  <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
    <path d="M12 20h9"/>
    <path d="M16.5 3.5a2.1 2.1 0 0 1 3 3L7 19l-4 1 1-4Z"/>
  </svg>
</a>


                {{-- Eliminar (ícono) --}}
               <form action="{{ route('usuarios.destroy', $u) }}"
      method="POST"
      class="inline"
      onsubmit="return confirm('¿Eliminar el usuario {{ $u->name }}?')">
  @csrf
  @method('DELETE')

  <button type="submit"
          class="btn-icon btn-delete"
          title="Eliminar">
    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
      <path d="M3 6h18"/>
      <path d="M8 6V4h8v2"/>
      <path d="M19 6l-1 14H6L5 6"/>
      <path d="M10 11v6"/>
      <path d="M14 11v6"/>
    </svg>
  </button>
</form>


              </div>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="5" class="px-4 py-6 text-center text-gray-500">
              No hay usuarios registrados.
            </td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>

  <div class="mt-4">
    {{ $usuarios->links() }}
  </div>

</div>
@endsection
