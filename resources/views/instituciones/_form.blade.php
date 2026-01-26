@php
  $idCodigo        = 'codigo';
  $idNombre        = 'nombre';
  $idSubsector     = 'subsector';
  $idNivelGob      = 'nivel_gobierno';
  $idParent        = 'parent_id';
  $idEstado        = 'estado';
@endphp

<div class="grid grid-cols-1 md:grid-cols-2 gap-6">

  {{-- Código --}}
  <div>
    <label for="{{ $idCodigo }}" class="block text-sm font-medium text-gray-700">
      Código <span class="text-red-600" aria-hidden="true">*</span>
    </label>
    <input
      id="{{ $idCodigo }}"
      type="number"
      name="codigo"
      inputmode="numeric"
      autocomplete="off"
      value="{{ old('codigo', $inst->codigo ?? '') }}"
      class="mt-1 w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-indigo-500 focus:border-indigo-500"
      required
      aria-required="true"
      aria-invalid="{{ $errors->has('codigo') ? 'true' : 'false' }}"
      aria-describedby="{{ $errors->has('codigo') ? 'err-codigo' : '' }}"
    >
    @error('codigo')
      <p id="err-codigo" class="mt-1 text-xs text-red-600" role="alert">{{ $message }}</p>
    @enderror
  </div>

  {{-- Nombre --}}
  <div>
    <label for="{{ $idNombre }}" class="block text-sm font-medium text-gray-700">
      Nombre <span class="text-red-600" aria-hidden="true">*</span>
    </label>
    <input
      id="{{ $idNombre }}"
      type="text"
      name="nombre"
      autocomplete="organization"
      value="{{ old('nombre', $inst->nombre ?? '') }}"
      class="mt-1 w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-indigo-500 focus:border-indigo-500"
      required
      aria-required="true"
      aria-invalid="{{ $errors->has('nombre') ? 'true' : 'false' }}"
      aria-describedby="{{ $errors->has('nombre') ? 'err-nombre' : '' }}"
    >
    @error('nombre')
      <p id="err-nombre" class="mt-1 text-xs text-red-600" role="alert">{{ $message }}</p>
    @enderror
  </div>

  {{-- Subsector --}}
  <div>
    <label for="{{ $idSubsector }}" class="block text-sm font-medium text-gray-700">
      Subsector
    </label>
    <input
      id="{{ $idSubsector }}"
      type="text"
      name="subsector"
      autocomplete="off"
      value="{{ old('subsector', $inst->subsector ?? '') }}"
      class="mt-1 w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-indigo-500 focus:border-indigo-500"
      aria-invalid="{{ $errors->has('subsector') ? 'true' : 'false' }}"
      aria-describedby="{{ $errors->has('subsector') ? 'err-subsector' : '' }}"
    >
    @error('subsector')
      <p id="err-subsector" class="mt-1 text-xs text-red-600" role="alert">{{ $message }}</p>
    @enderror
  </div>

  {{-- Nivel de Gobierno --}}
  <div>
    <label for="{{ $idNivelGob }}" class="block text-sm font-medium text-gray-700">
      Nivel de Gobierno
    </label>
    <input
      id="{{ $idNivelGob }}"
      type="text"
      name="nivel_gobierno"
      autocomplete="off"
      value="{{ old('nivel_gobierno', $inst->nivel_gobierno ?? '') }}"
      class="mt-1 w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-indigo-500 focus:border-indigo-500"
      aria-invalid="{{ $errors->has('nivel_gobierno') ? 'true' : 'false' }}"
      aria-describedby="{{ $errors->has('nivel_gobierno') ? 'err-nivel' : '' }}"
    >
    @error('nivel_gobierno')
      <p id="err-nivel" class="mt-1 text-xs text-red-600" role="alert">{{ $message }}</p>
    @enderror
  </div>

  {{-- Padre --}}
  <div>
    <label for="{{ $idParent }}" class="block text-sm font-medium text-gray-700">
      Padre
    </label>
    <select
      id="{{ $idParent }}"
      name="parent_id"
      class="mt-1 w-full border border-gray-300 rounded-lg px-3 py-2 bg-white focus:ring-indigo-500 focus:border-indigo-500"
      aria-invalid="{{ $errors->has('parent_id') ? 'true' : 'false' }}"
      aria-describedby="{{ $errors->has('parent_id') ? 'err-parent' : '' }}"
    >
      <option value="">— Ninguno —</option>
      @foreach ($padres as $p)
        <option value="{{ $p->idInstitucion }}"
          {{ old('parent_id', $inst->parent_id ?? '') == $p->idInstitucion ? 'selected' : '' }}>
          {{ $p->nombre }}
        </option>
      @endforeach
    </select>
    @error('parent_id')
      <p id="err-parent" class="mt-1 text-xs text-red-600" role="alert">{{ $message }}</p>
    @enderror
  </div>

  {{-- Estado --}}
  <div>
    <label for="{{ $idEstado }}" class="block text-sm font-medium text-gray-700">
      Estado
    </label>
    <select
      id="{{ $idEstado }}"
      name="estado"
      class="mt-1 w-full border border-gray-300 rounded-lg px-3 py-2 bg-white focus:ring-indigo-500 focus:border-indigo-500"
      aria-invalid="{{ $errors->has('estado') ? 'true' : 'false' }}"
      aria-describedby="{{ $errors->has('estado') ? 'err-estado' : '' }}"
    >
      <option value="activo" {{ old('estado', $inst->estado ?? 'activo')=='activo' ? 'selected' : '' }}>Activo</option>
      <option value="inactivo" {{ old('estado', $inst->estado ?? '')=='inactivo' ? 'selected' : '' }}>Inactivo</option>
    </select>
    @error('estado')
      <p id="err-estado" class="mt-1 text-xs text-red-600" role="alert">{{ $message }}</p>
    @enderror
  </div>

</div>
