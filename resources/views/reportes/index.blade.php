@extends('layouts.app')

@section('title','Reportes')

@section('content')
<div class="max-w-6xl mx-auto py-8">

    {{-- Header --}}
    <div class="flex items-center justify-between mb-4">
        <div>
            <h1 class="text-xl font-semibold text-gray-900">Listado de Reportes</h1>
            <p class="text-sm text-gray-500 mt-1">
                Reportes generados dentro del sistema.
            </p>
        </div>

        <a href="{{ route('reportes.create') }}" class="btn-primary">
            + Nuevo reporte
        </a>
    </div>

    {{-- Flash message --}}
    @if (session('success'))
        <div class="mb-4 rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-700">
            {{ session('success') }}
        </div>
    @endif

    {{-- Tabla --}}
    <div class="overflow-x-auto bg-white border border-gray-200 rounded-xl shadow-sm">
        <table class="min-w-full text-sm">
            <thead class="table-header">
                <tr>
                    <th class="px-4 py-2 text-left w-16">ID</th>
                    <th class="px-4 py-2 text-left">Nombre</th>
                    <th class="px-4 py-2 text-left w-32">Tipo</th>
                    <th class="px-4 py-2 text-left">Responsable</th>
                    <th class="px-4 py-2 text-left w-36">Creación</th>
                    <th class="px-4 py-2 text-right w-40">Acciones</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($reportes as $rep)
                    <tr class="table-row">
                        <td class="px-4 py-2 text-gray-700">
                            {{ $rep->id }}
                        </td>

                        <td class="px-4 py-2 text-gray-800 font-medium">
                            {{ $rep->nombre }}
                        </td>

                        <td class="px-4 py-2 text-gray-700">
                            {{ $rep->tipo }}
                        </td>

                        <td class="px-4 py-2 text-gray-700">
                            {{ $rep->responsable->name ?? '—' }}
                        </td>

                        <td class="px-4 py-2 text-gray-700">
                            {{ $rep->fecha_creacion }}
                        </td>
<td class="px-4 py-2 text-right">
  <div class="inline-flex items-center gap-2">
{{-- DESCARGAR --}}
<a href="{{ route('reportes.download', $rep) }}"
   class="btn-icon"
   title="Descargar PDF">
  <svg viewBox="0 0 24 24"
       fill="none"
       stroke="currentColor"
       stroke-width="2"
       class="w-4 h-4">
    <path d="M12 3v12"/>
    <path d="M7 10l5 5 5-5"/>
    <path d="M5 21h14"/>
  </svg>
</a>

    {{-- EDITAR --}}
    <a href="{{ route('reportes.edit', $rep) }}"
       class="btn-icon btn-edit"
       title="Editar">
      <svg viewBox="0 0 24 24"
           fill="none"
           stroke="currentColor"
           stroke-width="2"
           class="w-4 h-4">
        <path d="M12 20h9"/>
        <path d="M16.5 3.5a2.1 2.1 0 0 1 3 3L7 19l-4 1 1-4Z"/>
      </svg>
    </a>

    {{-- ELIMINAR --}}
    <form action="{{ route('reportes.destroy', $rep) }}"
          method="POST"
          onsubmit="return confirm('¿Eliminar este reporte?');">
      @csrf
      @method('DELETE')

      <button type="submit"
              class="btn-icon btn-delete"
              title="Eliminar">
        <svg viewBox="0 0 24 24"
             fill="none"
             stroke="currentColor"
             stroke-width="2"
             class="w-4 h-4">
          <path d="M3 6h18"/>
          <path d="M8 6V4h8v2"/>
          <path d="M10 11v6"/>
          <path d="M14 11v6"/>
          <path d="M5 6l1 14h12l1-14"/>
        </svg>
      </button>
    </form>

  </div>
</td>



                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-4 py-6 text-center text-gray-500">
                            No existen reportes registrados.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Paginación --}}
    <div class="mt-4">
        {{ $reportes->links() }}
    </div>

</div>
@endsection
