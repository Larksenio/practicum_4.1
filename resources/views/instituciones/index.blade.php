@extends('layouts.app')

@section('title', 'Instituciones')

@section('content')
<main class="max-w-6xl mx-auto py-8" role="main" aria-labelledby="page-title">

  <header class="flex items-center justify-between mb-4">
    <h1 id="page-title" class="text-xl font-semibold text-gray-900">
      Listado de instituciones
    </h1>

    @can('instituciones.create')
      <a href="{{ route('instituciones.create') }}" class="btn-primary">
        <span aria-hidden="true">+</span> Nueva Institución
      </a>
    @endcan
  </header>

  <section aria-label="Tabla de instituciones">
    <div class="overflow-x-auto bg-white border border-gray-200 rounded-xl shadow-sm">
      <table class="min-w-full text-sm">
        <caption class="sr-only">
          Listado de instituciones registradas en el sistema, con código, nombre, institución padre, estado y acciones.
        </caption>

        <thead class="table-header">
          <tr>
            <th scope="col" class="px-4 py-2 text-left w-12">#</th>
            <th scope="col" class="px-4 py-2 text-left w-32">Código</th>
            <th scope="col" class="px-4 py-2 text-left">Nombre</th>
            <th scope="col" class="px-4 py-2 text-left w-56">Padre</th>
            <th scope="col" class="px-4 py-2 text-center w-32">Estado</th>
            <th scope="col" class="px-4 py-2 text-right w-40">Acciones</th>
          </tr>
        </thead>

        <tbody>
          @forelse($instituciones as $institucion)
            <tr class="table-row">
              <td class="px-4 py-2 text-xs text-gray-500">
                {{ $instituciones->firstItem() + $loop->index }}
              </td>

              <td class="px-4 py-2 font-mono text-xs text-gray-700">
                {{ $institucion->codigo }}
              </td>

              <td class="px-4 py-2 text-gray-800">
                {{ $institucion->nombre ?? '—' }}
              </td>

              <td class="px-4 py-2 text-gray-600">
                {{ optional($institucion->padre)->nombre ?? '—' }}
              </td>

              <td class="px-4 py-2 text-center">
                @if($institucion->estado === 'activo')
                  <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-green-100 text-green-700">
                    Activo
                  </span>
                @else
                  <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-red-100 text-red-700">
                    Inactivo
                  </span>
                @endif
              </td>

              <td class="px-4 py-2 text-right">
                <div class="inline-flex items-center gap-3" aria-label="Acciones de la institución">

                  @can('instituciones.edit')
                    <a href="{{ route('instituciones.edit', $institucion) }}"
                       class="btn-icon btn-edit"
                       title="Editar"
                       aria-label="Editar institución {{ $institucion->nombre }}">
                      <svg aria-hidden="true" focusable="false" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M12 20h9"/>
                        <path d="M16.5 3.5a2.1 2.1 0 0 1 3 3L7 19l-4 1 1-4Z"/>
                      </svg>
                      <span class="sr-only">Editar</span>
                    </a>
                  @endcan

                  @can('instituciones.delete')
                    <form action="{{ route('instituciones.destroy', $institucion) }}"
                          method="POST"
                          class="inline"
                          onsubmit="return confirm('¿Eliminar la institución {{ $institucion->nombre }}?')">
                      @csrf
                      @method('DELETE')

                      <button type="submit"
                              class="btn-icon btn-delete"
                              title="Eliminar"
                              aria-label="Eliminar institución {{ $institucion->nombre }}">
                        <svg aria-hidden="true" focusable="false" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                          <path d="M3 6h18"/>
                          <path d="M8 6V4h8v2"/>
                          <path d="M19 6l-1 14H6L5 6"/>
                          <path d="M10 11v6"/>
                          <path d="M14 11v6"/>
                        </svg>
                        <span class="sr-only">Eliminar</span>
                      </button>
                    </form>
                  @endcan

                </div>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="6" class="px-4 py-6 text-center text-gray-500">
                No hay instituciones registradas.
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </section>

  <nav class="mt-4" aria-label="Paginación de instituciones">
    {{ $instituciones->links() }}
  </nav>

</main>
@endsection
