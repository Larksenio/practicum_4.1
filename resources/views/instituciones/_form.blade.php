@csrf
<div class="grid grid-cols-2 gap-4">

  {{-- Código --}}
  <label class="block">
    <span class="text-sm font-medium">Código</span>
    <input type="number" name="codigo"
           value="{{ old('codigo', $inst->codigo ?? '') }}"
           class="border rounded px-2 py-1 w-full" required>
  </label>

  {{-- Nombre --}}
  <label class="block">
    <span class="text-sm font-medium">Nombre</span>
    <input type="text" name="nombre"
           value="{{ old('nombre', $inst->nombre ?? '') }}"
           class="border rounded px-2 py-1 w-full" required>
  </label>

  {{-- Subsector --}}
  <label class="block">
    <span class="text-sm font-medium">Subsector</span>
    <input type="text" name="subsector"
           value="{{ old('subsector', $inst->subsector ?? '') }}"
           class="border rounded px-2 py-1 w-full">
  </label>

  {{-- Nivel de Gobierno --}}
  <label class="block">
    <span class="text-sm font-medium">Nivel de Gobierno</span>
    <input type="text" name="nivel_gobierno"
           value="{{ old('nivel_gobierno', $inst->nivel_gobierno ?? '') }}"
           class="border rounded px-2 py-1 w-full">
  </label>

  {{-- Padre (jerarquía) --}}
  <label class="block col-span-2 md:col-span-1">
    <span class="text-sm font-medium">Padre</span>
    <select name="parent_id" class="border rounded px-2 py-1 w-full">
      <option value="">— Ninguno —</option>
      @foreach ($padres as $p)
        <option value="{{ $p->idInstitucion }}"
          {{ old('parent_id', $inst->parent_id ?? '') == $p->idInstitucion ? 'selected' : '' }}>
          {{ $p->nombre }}
        </option>
      @endforeach
    </select>
  </label>

  {{-- Estado --}}
  <label class="block col-span-2 md:col-span-1">
    <span class="text-sm font-medium">Estado</span>
    <select name="estado" class="border rounded px-2 py-1 w-full" required>
      <option value="activo"   {{ old('estado', $inst->estado ?? 'activo')=='activo' ? 'selected' : '' }}>Activo</option>
      <option value="inactivo" {{ old('estado', $inst->estado ?? '')=='inactivo' ? 'selected' : '' }}>Inactivo</option>
    </select>
  </label>

</div>

<button class="mt-4 bg-green-600 text-black px-4 py-1 rounded">Guardar</button>
<a href="{{ route('instituciones.index') }}" class="ml-3">Volver</a>
