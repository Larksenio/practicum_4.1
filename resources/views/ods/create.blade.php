@extends('layouts.app')

@section('title', isset($od) ? 'Editar ODS' : 'Nuevo ODS')

@section('content')
<div class="max-w-6xl mx-auto py-8">
    {{-- Header --}}
    <div class="mb-6">
        <h1 class="text-xl font-semibold text-gray-900">
            {{ isset($od) ? 'Editar ODS' : 'Crear ODS' }}
        </h1>
        <p class="text-sm text-gray-500">
            Completa la información del ODS y guarda los cambios.
        </p>
    </div>

    {{-- Card --}}
    <div class="bg-white border border-gray-200 rounded-xl shadow-sm">
        <div class="p-6">
            {{-- Errores --}}
            @if($errors->any())
                <div class="mb-4 rounded-lg bg-red-50 border border-red-200 px-4 py-3 text-sm text-red-700">
                    <ul class="list-disc pl-5 space-y-1">
                        @foreach($errors->all() as $e)
                            <li>{{ $e }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form
                action="{{ isset($od) ? route('ods.update', $od) : route('ods.store') }}"
                method="POST"
                class="space-y-6"
            >
                @csrf
                @isset($od)
                    @method('PUT')
                @endisset

                {{-- Grid --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    {{-- Código --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Código</label>
                        <input
                            type="number"
                            name="codigo"
                            required
                            value="{{ old('codigo', $od->codigo ?? '') }}"
                            class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                        >
                    </div>

                   {{-- Metas del ODS --}}
<div class="md:col-span-2">
  <div class="flex items-center justify-between mb-2">
    <label class="block text-sm font-medium text-gray-700">Metas del ODS</label>
    <button type="button" id="addMetaBtn"
      class="text-sm font-semibold text-indigo-600 hover:text-indigo-800">
      + Agregar nueva meta
    </button>
  </div>

  <div id="metasWrap" class="space-y-3">
    {{-- Si vienes con old() por error de validación --}}
    @php $oldMetas = old('metas', []); @endphp

    @foreach($oldMetas as $i => $m)
      <div class="grid grid-cols-1 md:grid-cols-3 gap-3 p-3 border rounded-lg">
        <div>
          <label class="text-xs text-gray-600">Código meta (ej: 1.1 / 1.a)</label>
          <input name="metas[{{ $i }}][codigo]" value="{{ $m['codigo'] ?? '' }}"
            class="w-full rounded-lg border-gray-300 px-3 py-2 text-sm">
        </div>
        <div class="md:col-span-2">
          <label class="text-xs text-gray-600">Descripción</label>
          <input name="metas[{{ $i }}][descripcion]" value="{{ $m['descripcion'] ?? '' }}"
            class="w-full rounded-lg border-gray-300 px-3 py-2 text-sm">
        </div>
        <div class="md:col-span-3 text-right">
          <button type="button" class="removeMeta text-xs text-red-600 hover:text-red-800">
            Quitar
          </button>
        </div>
      </div>
    @endforeach
  </div>
</div>

<script>
  (function(){
    const wrap = document.getElementById('metasWrap');
    const btn  = document.getElementById('addMetaBtn');

    const row = (i) => `
      <div class="grid grid-cols-1 md:grid-cols-3 gap-3 p-3 border rounded-lg">
        <div>
          <label class="text-xs text-gray-600">Código meta (ej: 1.1 / 1.a)</label>
          <input name="metas[${i}][codigo]" class="w-full rounded-lg border-gray-300 px-3 py-2 text-sm">
        </div>
        <div class="md:col-span-2">
          <label class="text-xs text-gray-600">Descripción</label>
          <input name="metas[${i}][descripcion]" class="w-full rounded-lg border-gray-300 px-3 py-2 text-sm">
        </div>
        <div class="md:col-span-3 text-right">
          <button type="button" class="removeMeta text-xs text-red-600 hover:text-red-800">Quitar</button>
        </div>
      </div>
    `;

    btn?.addEventListener('click', () => {
      const i = wrap.children.length;
      wrap.insertAdjacentHTML('beforeend', row(i));
    });

    wrap?.addEventListener('click', (e) => {
      if(e.target.classList.contains('removeMeta')){
        e.target.closest('.border')?.remove();
      }
    });
  })();
</script>

                    {{-- Nombre --}}
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nombre</label>
                        <input
                            type="text"
                            name="nombre"
                            required
                            value="{{ old('nombre', $od->nombre ?? '') }}"
                            class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                        >
                    </div>

                    {{-- Descripción --}}
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Descripción</label>
                        <textarea
                            name="descripcion"
                            rows="4"
                            required
                            class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                        >{{ old('descripcion', $od->descripcion ?? '') }}</textarea>
                    </div>
                </div>

                {{-- Footer botones --}}
                <div class="flex justify-end gap-3 pt-4 border-t border-gray-100">
                    <a href="{{ route('ods.index') }}" class="btn-secondary">
                        Volver
                    </a>
                    <button type="submit" class="btn-primary">
                        Guardar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
