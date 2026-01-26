@extends('layouts.app')

@section('title', 'Objetivos')

@section('content')
<main class="max-w-6xl mx-auto py-8" role="main" aria-labelledby="page-title">

  <header class="flex items-center justify-between mb-4">
    <div>
      <h1 id="page-title" class="text-xl font-semibold text-gray-900">
        Listado de objetivos estratégicos
      </h1>
      <p class="text-sm text-gray-500 mt-1">Administra los objetivos y sus versiones.</p>
    </div>

    @can('objetivos.create')
      <a href="{{ route('objetivos.create') }}" class="btn-primary">
        <span aria-hidden="true">+</span> Nuevo objetivo
      </a>
    @endcan
  </header>

  <section aria-label="Tabla de objetivos">
    <div class="overflow-x-auto bg-white border border-gray-200 rounded-xl shadow-sm">
      <table class="min-w-full text-sm">
        <caption class="sr-only">
          Listado de objetivos estratégicos con código, descripción, versión, fecha de registro y acciones.
        </caption>

        <thead class="table-header">
          <tr>
            <th scope="col" class="px-4 py-2 text-left w-32">Código</th>
            <th scope="col" class="px-4 py-2 text-left">Descripción</th>
            <th scope="col" class="px-4 py-2 text-center w-28">Versión</th>
            <th scope="col" class="px-4 py-2 text-left w-40">Fecha registro</th>
            <th scope="col" class="px-4 py-2 text-right w-40">Acciones</th>
          </tr>
        </thead>

        <tbody>
          @forelse ($objetivos as $obj)
            <tr class="table-row">
              <td class="px-4 py-2 font-mono text-xs text-gray-700">
                {{ $obj->codigo }}
              </td>

              <td class="px-4 py-2 text-gray-800">
                <span class="block max-w-3xl truncate" title="{{ $obj->descripcion }}">
                  {{ $obj->descripcion }}
                </span>
              </td>

              <td class="px-4 py-2 text-center">
                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-700">
                  {{ $obj->version }}
                </span>
              </td>

              <td class="px-4 py-2 text-gray-600">
                <time datetime="{{ \Carbon\Carbon::parse($obj->fecha_registro)->toDateString() }}">
                  {{ \Carbon\Carbon::parse($obj->fecha_registro)->format('Y-m-d') }}
                </time>
              </td>

              <td class="px-4 py-2 text-right">
                <div class="inline-flex items-center gap-2" aria-label="Acciones del objetivo">

                  @can('objetivos.edit')
                    <a href="{{ route('objetivos.edit', $obj) }}"
                       class="btn-icon btn-edit"
                       title="Editar"
                       aria-label="Editar objetivo {{ $obj->codigo }}">
                      <svg aria-hidden="true" focusable="false" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="w-4 h-4">
                        <path d="M12 20h9"/>
                        <path d="M16.5 3.5a2.1 2.1 0 0 1 3 3L7 19l-4 1 1-4Z"/>
                      </svg>
                      <span class="sr-only">Editar</span>
                    </a>
                  @endcan

                  @can('objetivos.delete')
                    <form action="{{ route('objetivos.destroy', $obj) }}"
                          method="POST"
                          class="inline"
                          onsubmit="return confirm('¿Eliminar objetivo {{ $obj->codigo }}?');">
                      @csrf
                      @method('DELETE')

                      <button type="submit"
                              class="btn-icon btn-delete"
                              title="Eliminar"
                              aria-label="Eliminar objetivo {{ $obj->codigo }}">
                        <svg aria-hidden="true" focusable="false" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="w-4 h-4">
                          <path d="M3 6h18"/>
                          <path d="M8 6V4h8v2"/>
                          <path d="M10 11v6"/>
                          <path d="M14 11v6"/>
                          <path d="M5 6l1 14h12l1-14"/>
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
              <td colspan="5" class="px-4 py-6 text-center text-gray-500">
                No hay objetivos registrados.
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </section>

  <nav class="mt-4" aria-label="Paginación de objetivos">
    {{ $objetivos->links() }}
  </nav>

</main>
@endsection
