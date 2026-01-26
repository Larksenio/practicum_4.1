@extends('layouts.app')

@section('title','Programas')

@section('content')
<div class="max-w-6xl mx-auto py-8">

    <div class="flex items-center justify-between mb-4">
        <div>
            <h1 class="text-xl font-semibold text-gray-900">Programas</h1>
            <p class="text-sm text-gray-500 mt-1">
                Listado de programas registrados en el sistema.
            </p>
        </div>

        @can('programas.create')
            <a href="{{ route('programas.create') }}" class="btn-primary">
                + Nuevo Programa
            </a>
        @endcan
    </div>

    <div class="overflow-x-auto bg-white border border-gray-200 rounded-xl shadow-sm">
        <table class="min-w-full text-sm">
            <thead class="table-header">
                <tr>
                    <th class="px-4 py-2 text-left">Institución</th>
                    <th class="px-4 py-2 text-left">Nombre</th>
                    <th class="px-4 py-2 text-center w-36">Estado</th>
                    <th class="px-4 py-2 text-right w-44">Acciones</th>
                </tr>
            </thead>

            <tbody>
                @forelse($programas as $p)
                    <tr class="table-row">
                        <td class="px-4 py-2 text-gray-800">
                            {{ $p->institucion->nombre ?? '—' }}
                        </td>

                        <td class="px-4 py-2 text-gray-800">
                            {{ $p->nombre ?? '—' }}
                        </td>

                        <td class="px-4 py-2 text-center">
                            @if(($p->estado ?? '') === 'activo') 
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-green-100 text-green-700">
                                    activo
                                </span>
                            @else
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-red-100 text-red-700">
                                    {{ $p->estado ?? 'inactivo' }}
                                </span>
                            @endif
                        </td>

                       <td class="px-4 py-2 text-right">
  <div class="inline-flex items-center gap-2">

    @can('programas.edit')
      <a href="{{ route('programas.edit', $p) }}"
         class="btn-icon btn-edit"
         title="Editar">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="w-4 h-4">
          <path d="M12 20h9"/>
          <path d="M16.5 3.5a2.1 2.1 0 0 1 3 3L7 19l-4 1 1-4Z"/>
        </svg>
      </a>
    @endcan

    @can('programas.delete')
      <form action="{{ route('programas.destroy', $p) }}"
            method="POST"
            class="inline"
            onsubmit="return confirm('¿Eliminar el programa {{ $p->nombre }}?');">
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
                        <td colspan="4" class="px-4 py-6 text-center text-gray-500">
                            Sin registros.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $programas->links() }}
    </div>

</div>
@endsection
