@extends('layouts.app')

@section('title', 'Proyectos')

@section('content')
<div class="max-w-6xl mx-auto py-8 space-y-4">

  {{-- Encabezado --}}
  <div class="flex items-start justify-between gap-4">
    <div>
      <h1 class="text-xl font-semibold text-gray-900">Listado de proyectos</h1>
      <p class="text-sm text-gray-500 mt-1">Administra la cartera de proyectos por institución.</p>
    </div>

    @can('proyectos.create')
      <a href="{{ route('proyectos.create') }}" class="btn-primary">
        + Nuevo proyecto
      </a>
    @endcan
  </div>

  {{-- Tabla --}}
  <div class="overflow-x-auto bg-white border border-gray-200 rounded-xl shadow-sm">
    <table class="min-w-full text-sm">
      <thead class="table-header">
        <tr>
          <th class="px-4 py-2 text-left w-20">ID</th>
          <th class="px-4 py-2 text-left w-56">Institución</th>
          <th class="px-4 py-2 text-left w-56">Nombre</th>
          <th class="px-4 py-2 text-left">Descripción</th>
          <th class="px-4 py-2 text-center w-28">Estado</th>
          <th class="px-4 py-2 text-right w-36">Acciones</th>
        </tr>
      </thead>

      <tbody>
        @forelse($proyectos as $proyecto)
          <tr class="table-row">
            <td class="px-4 py-2 text-gray-500">
              {{ $proyecto->idProyecto }}
            </td>

            <td class="px-4 py-2 text-gray-700">
              {{ optional($proyecto->institucion)->nombre ?? '—' }}
            </td>

            <td class="px-4 py-2 text-gray-900 font-medium">
              {{ $proyecto->nombre ?? '—' }}
            </td>

            <td class="px-4 py-2 text-gray-600">
              <span class="block max-w-2xl truncate" title="{{ $proyecto->descripcion }}">
                {{ $proyecto->descripcion ?? '—' }}
              </span>
            </td>

            <td class="px-4 py-2 text-center">
              @if(($proyecto->estado ?? '') === 'activo')
                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-green-100 text-green-700">
                  activo
                </span>
              @else
                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-red-100 text-red-700">
                  {{ $proyecto->estado ?? 'inactivo' }}
                </span>
              @endif
            </td>

            <td class="px-4 py-2 text-right">
              <div class="inline-flex items-center gap-2">

                @can('proyectos.edit')
                  <a href="{{ route('proyectos.edit', $proyecto) }}"
                     class="btn-icon btn-edit"
                     title="Editar">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="w-4 h-4">
                      <path d="M12 20h9"/>
                      <path d="M16.5 3.5a2.1 2.1 0 0 1 3 3L7 19l-4 1 1-4Z"/>
                    </svg>
                  </a>
                @endcan

                @can('proyectos.delete')
                  <form action="{{ route('proyectos.destroy', $proyecto) }}"
                        method="POST"
                        onsubmit="return confirm('¿Desea eliminar este proyecto?');">
                    @csrf
                    @method('DELETE')

                    <button type="submit" class="btn-icon btn-delete" title="Eliminar">
                      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="w-4 h-4">
                        <path d="M3 6h18"/>
                        <path d="M8 6V4h8v2"/>
                        <path d="M19 6l-1 14H6L5 6"/>
                        <path d="M10 11v6"/>
                        <path d="M14 11v6"/>
                      </svg>
                    </button>
                  </form>
                @endcan

              </div>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="6" class="px-4 py-6 text-center text-gray-500">
              No hay proyectos registrados.
            </td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>

  {{-- Paginación (si activas paginate en el controlador) --}}
  {{-- <div class="mt-4">{{ $proyectos->links() }}</div> --}}

</div>
@endsection
