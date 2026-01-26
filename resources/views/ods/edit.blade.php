@extends('layouts.app')

@section('title', 'Editar ODS')

@section('content')
<div class="max-w-6xl mx-auto py-8">
    <div class="mb-6">
        <h1 class="text-xl font-semibold text-gray-900">Editar ODS</h1>
        <p class="text-sm text-gray-500">
            Actualiza la información del ODS y sus metas.
        </p>
    </div>

    <div class="bg-white border border-gray-200 rounded-xl shadow-sm">
        <div class="p-6">

            @if($errors->any())
                <div class="mb-4 rounded-lg bg-red-50 border border-red-200 px-4 py-3 text-sm text-red-700">
                    <ul class="list-disc pl-5 space-y-1">
                        @foreach($errors->all() as $e)
                            <li>{{ $e }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('ods.update', $od) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    {{-- Código ODS --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Código</label>
                        <input type="number" name="codigo" required
                               value="{{ old('codigo', $od->codigo) }}"
                               class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:ring-2 focus:ring-indigo-500">
                    </div>

                    {{-- Nombre --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nombre</label>
                        <input type="text" name="nombre" required
                               value="{{ old('nombre', $od->nombre) }}"
                               class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:ring-2 focus:ring-indigo-500">
                    </div>

                    {{-- Descripción --}}
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Descripción</label>
                        <textarea name="descripcion" rows="4" required
                                  class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:ring-2 focus:ring-indigo-500">{{ old('descripcion', $od->descripcion) }}</textarea>
                    </div>

                    {{-- Metas --}}
                    <div class="md:col-span-2">
                        <div class="flex items-center justify-between mb-2">
                            <label class="block text-sm font-medium text-gray-700">Metas del ODS</label>

                            <button type="button" id="addMetaBtn"
                                    class="text-sm font-semibold text-indigo-600 hover:text-indigo-800">
                                + Agregar nueva meta
                            </button>
                        </div>

                        <div id="metasWrap" class="space-y-3">
                            @php
                                // Si hubo error de validación, usamos old('metas')
                                $metas = old('metas');

                                // Si no hay old, cargamos las metas actuales del ODS
                                if ($metas === null) {
                                    $metas = $od->metas->map(function($m){
                                        return [
                                            'id' => $m->id,
                                            'codigo' => $m->codigo,
                                            'descripcion' => $m->descripcion,
                                        ];
                                    })->toArray();
                                }
                            @endphp

                            @foreach($metas as $i => $m)
                                <div class="meta-row grid grid-cols-1 md:grid-cols-3 gap-3 p-3 border rounded-lg">
                                    {{-- id oculto (sirve para update) --}}
                                    <input type="hidden" name="metas[{{ $i }}][id]" value="{{ $m['id'] ?? '' }}">

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
                                        <button type="button"
                                                class="removeMeta text-xs font-semibold text-red-600 hover:text-red-800">
                                            Quitar
                                        </button>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <p class="text-xs text-gray-500 mt-2">
                            Tip: usa códigos como 1.1, 1.2, 1.a según el documento oficial.
                        </p>
                    </div>
                </div>

                <div class="flex justify-end gap-3 pt-4 border-t border-gray-100">
                    <a href="{{ route('ods.index') }}" class="btn-secondary">Volver</a>
                    <button type="submit" class="btn-primary">Guardar cambios</button>
                </div>
            </form>

        </div>
    </div>
</div>

<script>
(function(){
    const wrap = document.getElementById('metasWrap');
    const btn  = document.getElementById('addMetaBtn');

    const row = (i) => `
      <div class="meta-row grid grid-cols-1 md:grid-cols-3 gap-3 p-3 border rounded-lg">
        <input type="hidden" name="metas[${i}][id]" value="">
        <div>
          <label class="text-xs text-gray-600">Código meta (ej: 1.1 / 1.a)</label>
          <input name="metas[${i}][codigo]" class="w-full rounded-lg border-gray-300 px-3 py-2 text-sm">
        </div>
        <div class="md:col-span-2">
          <label class="text-xs text-gray-600">Descripción</label>
          <input name="metas[${i}][descripcion]" class="w-full rounded-lg border-gray-300 px-3 py-2 text-sm">
        </div>
        <div class="md:col-span-3 text-right">
          <button type="button" class="removeMeta text-xs font-semibold text-red-600 hover:text-red-800">Quitar</button>
        </div>
      </div>
    `;

    btn?.addEventListener('click', () => {
      const i = wrap.querySelectorAll('.meta-row').length;
      wrap.insertAdjacentHTML('beforeend', row(i));
    });

    wrap?.addEventListener('click', (e) => {
      if(e.target.classList.contains('removeMeta')){
        e.target.closest('.meta-row')?.remove();
      }
    });
})();
</script>
@endsection
