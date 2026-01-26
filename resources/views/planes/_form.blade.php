@csrf
@php
  // Para “create” $plan es null; evitamos warnings con null-coalescing
@endphp

<div class="grid grid-cols-1 md:grid-cols-2 gap-4">

    {{-- Programa --}}
    <div class="md:col-span-2">
        <label class="block text-sm font-medium text-gray-700 mb-1">Programa</label>
        <select name="programa_id" required
            class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm bg-white
                   focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
            <option value="">— Seleccione —</option>
            @foreach($programas as $id => $nombre)
                <option value="{{ $id }}"
                    {{ old('programa_id', $plan->programa_id ?? '') == $id ? 'selected' : '' }}>
                    {{ $nombre }}
                </option>
            @endforeach
        </select>
    </div>

    {{-- Código --}}
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Código</label>
        <input type="text" name="codigo"
               value="{{ old('codigo', $plan->codigo ?? '') }}"
               class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm">
    </div>

    {{-- Versión --}}
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Versión</label>
        <input type="number" name="version"
               value="{{ old('version', $plan->version ?? 1) }}"
               class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm">
    </div>

    {{-- Nombre --}}
    <div class="md:col-span-2">
        <label class="block text-sm font-medium text-gray-700 mb-1">Nombre</label>
        <input type="text" name="nombre"
               value="{{ old('nombre', $plan->nombre ?? '') }}"
               class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm">
    </div>

    {{-- Descripción --}}
    <div class="md:col-span-2">
        <label class="block text-sm font-medium text-gray-700 mb-1">Descripción</label>
        <textarea name="descripcion"
                  class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm"
                  rows="3">{{ old('descripcion', $plan->descripcion ?? '') }}</textarea>
    </div>

    {{-- Estado --}}
    <div class="md:col-span-2">
        <label class="block text-sm font-medium text-gray-700 mb-1">Estado</label>
        <select name="estado"
            class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm">
            <option value="activo" {{ old('estado', $plan->estado ?? 'activo') == 'activo' ? 'selected' : '' }}>
                Activo
            </option>
            <option value="inactivo" {{ old('estado', $plan->estado ?? '') == 'inactivo' ? 'selected' : '' }}>
                Inactivo
            </option>
        </select>
    </div>

</div>
