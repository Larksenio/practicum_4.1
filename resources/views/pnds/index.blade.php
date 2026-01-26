@extends('layouts.app')

@section('title', 'PND')

@section('content')
<div class="max-w-6xl mx-auto py-8">

    <div class="flex items-center justify-between mb-4">
        <h1 class="text-xl font-semibold text-gray-900">
            Listado de PND
        </h1>

        <a href="{{ route('pnds.create') }}" class="btn-primary">
            + Nuevo
        </a>
    </div>

    {{-- Tabla --}}
    <div class="overflow-x-auto bg-white border border-gray-200 rounded-xl shadow-sm">
        <table class="min-w-full text-sm">
            <thead class="table-header">
                <tr>
                    <th class="px-4 py-2 text-left w-24">Código</th>
                    <th class="px-4 py-2 text-left">Nombre</th>
                    <th class="px-4 py-2 text-left w-56">Eje</th>
                    <th class="px-4 py-2 text-right w-40">Acciones</th>
                </tr>
            </thead>

            <tbody>
                @forelse($pnds as $p)
                    <tr class="table-row">
                        <td class="px-4 py-2 font-mono text-xs text-gray-700">
                            {{ $p->codigo }}
                        </td>

                       <td class="px-4 py-2 text-gray-800">
    {{ $p->nombre ?? '—' }}
</td>

<td class="px-4 py-2 text-gray-700">
    {{ $p->eje?->nombre ?? '—' }}
</td>



                <td class="px-4 py-2 text-right">
  <div class="inline-flex items-center gap-2">

    {{-- EDITAR --}}
    <a href="{{ route('pnds.edit', $p) }}"
       class="btn-icon btn-edit"
       title="Editar">
      <svg viewBox="0 0 24 24" fill="none"
           stroke="currentColor" stroke-width="2"
           class="w-4 h-4">
        <path d="M12 20h9"/>
        <path d="M16.5 3.5a2.1 2.1 0 0 1 3 3L7 19l-4 1 1-4Z"/>
      </svg>
    </a>

    {{-- ELIMINAR --}}
    <form action="{{ route('pnds.destroy', $p) }}"
          method="POST"
          onsubmit="return confirm('¿Eliminar este PND?');">
      @csrf
      @method('DELETE')

      <button type="submit"
              class="btn-icon btn-delete"
              title="Eliminar">
        <svg viewBox="0 0 24 24" fill="none"
             stroke="currentColor" stroke-width="2"
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
                        <td colspan="4" class="px-4 py-6 text-center text-gray-500">
                            No hay registros.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Paginación --}}
    <div class="mt-4">
        {{ $pnds->links() }}
    </div>

</div>
@endsection
