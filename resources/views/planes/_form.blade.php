@csrf
@php
  // Para “create” $plan es null; evitamos warnings con null-coalescing
@endphp

<div class="grid grid-cols-2 gap-4">

  {{-- Programa --}}
  <label class="block col-span-2 md:col-span-1">
    <span class="text-sm font-medium">Programa</span>
    <select name="programa_id" class="border rounded px-2 py-1 w-full" required>
      <option value="">— Seleccione —</option>
      @foreach ($programas as $id=>$nombre)
        <option value="{{ $id }}"
          {{ old('programa_id', $plan->programa_id ?? '') == $id ? 'selected' : '' }}>
          {{ $nombre }}
        </option>
      @endforeach
    </select>
  </label>

  {{-- Código --}}
  <label class="block col-span-2 md:col-span-1">
    <span class="text-sm font-medium">Código</span>
    <input type="number" name="codigo"
           value="{{ old('codigo', $plan->codigo ?? '') }}"
           class="border rounded px-2 py-1 w-full" required>
  </label>

  {{-- Versión --}}
  <label class="block col-span-2 md:col-span-1">
    <span class="text-sm font-medium">Versión</span>
    <input type="number" name="version"
           value="{{ old('version', $plan->version ?? 1) }}"
           class="border rounded px-2 py-1 w-full" required>
  </label>

  {{-- Nombre --}}
  <label class="block col-span-2 md:col-span-1">
    <span class="text-sm font-medium">Nombre</span>
    <input type="text" name="nombre"
           value="{{ old('nombre', $plan->nombre ?? '') }}"
           class="border rounded px-2 py-1 w-full" required>
  </label>

  {{-- Descripción --}}
  <label class="block col-span-2">
    <span class="text-sm font-medium">Descripción</span>
    <textarea name="descripcion" rows="3"
              class="border rounded px-2 py-1 w-full">{{ old('descripcion', $plan->descripcion ?? '') }}</textarea>
  </label>

  {{-- Estado --}}
  <label class="block col-span-2 md:col-span-1">
    <span class="text-sm font-medium">Estado</span>
    <select name="estado" class="border rounded px-2 py-1 w-full" required>
      <option value="activo"   {{ old('estado', $plan->estado ?? 'activo')=='activo' ? 'selected' : '' }}>Activo</option>
      <option value="inactivo" {{ old('estado', $plan->estado ?? '')=='inactivo' ? 'selected' : '' }}>Inactivo</option>
    </select>
  </label>
</div>

<button class="mt-4 bg-green-600 text-black px-4 py-1 rounded">Guardar</button>
<a href="{{ route('planes.index') }}" class="ml-3">Volver</a>
