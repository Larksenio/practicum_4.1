@csrf
<div class="grid grid-cols-2 gap-4">

  {{-- Institución --}}
  <label class="block col-span-2 md:col-span-1">
    <span class="text-sm font-medium">Institución</span>
    <select name="institucion_id" class="border rounded px-2 py-1 w-full" required>
      <option value="">— Seleccione —</option>
      @foreach ($instituciones as $id=>$nombre)
        <option value="{{ $id }}"
          {{ old('institucion_id', $prog->institucion_id ?? '') == $id ? 'selected' : '' }}>
          {{ $nombre }}
        </option>
      @endforeach
    </select>
  </label>

  {{-- Nombre --}}
  <label class="block col-span-2 md:col-span-1">
    <span class="text-sm font-medium">Nombre</span>
    <input type="text" name="nombre"
           value="{{ old('nombre', $prog->nombre ?? '') }}"
           class="border rounded px-2 py-1 w-full" required>
  </label>

  {{-- Descripción --}}
  <label class="block col-span-2">
    <span class="text-sm font-medium">Descripción</span>
    <textarea name="descripcion" rows="3"
              class="border rounded px-2 py-1 w-full">{{ old('descripcion', $prog->descripcion ?? '') }}</textarea>
  </label>

  {{-- Estado --}}
  <label class="block col-span-2 md:col-span-1">
    <span class="text-sm font-medium">Estado</span>
    <select name="estado" class="border rounded px-2 py-1 w-full" required>
      <option value="activo"   {{ old('estado', $prog->estado ?? 'activo')=='activo' ? 'selected' : '' }}>Activo</option>
      <option value="inactivo" {{ old('estado', $prog->estado ?? '')=='inactivo' ? 'selected' : '' }}>Inactivo</option>
    </select>
  </label>
</div>

<button class="mt-4 bg-green-600 text-black px-4 py-1 rounded">Guardar</button>
<a href="{{ route('programas.index') }}" class="ml-3">Volver</a>
