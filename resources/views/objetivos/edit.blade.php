@extends('layouts.app')

@section('title', 'Editar objetivo')

@section('content')
<main class="max-w-4xl mx-auto py-8" role="main" aria-labelledby="page-title">

  <header class="mb-6">
    <h1 id="page-title" class="text-xl font-semibold text-gray-900">Editar objetivo</h1>
    <p class="text-sm text-gray-500 mt-1">
      Actualiza la información del objetivo y guarda los cambios.
    </p>
  </header>

  @if ($errors->any())
    <div class="mb-4 rounded-lg bg-red-50 p-4 text-sm text-red-700" role="alert" aria-live="polite">
      <p class="font-semibold mb-2">Revisa los campos:</p>
      <ul class="list-disc pl-5 space-y-1">
        @foreach ($errors->all() as $e)
          <li>{{ $e }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  <section class="bg-white border border-gray-200 rounded-xl shadow-sm p-6" aria-label="Formulario editar objetivo">
    <form action="{{ route('objetivos.update', $objetivo) }}" method="POST" class="space-y-6">
      @csrf
      @method('PUT')

      <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

        {{-- Código --}}
        <div>
          <label for="codigo" class="block text-sm font-medium text-gray-700 mb-1">
            Código <span class="text-red-600" aria-hidden="true">*</span>
          </label>
          <input id="codigo" type="number" name="codigo" required inputmode="numeric"
                 value="{{ old('codigo', $objetivo->codigo) }}"
                 aria-required="true"
                 aria-invalid="{{ $errors->has('codigo') ? 'true' : 'false' }}"
                 aria-describedby="{{ $errors->has('codigo') ? 'err-codigo' : '' }}"
                 class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm
                        focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
          @error('codigo')
            <p id="err-codigo" class="mt-1 text-xs text-red-600" role="alert">{{ $message }}</p>
          @enderror
        </div>

        {{-- Versión --}}
        <div>
          <label for="version" class="block text-sm font-medium text-gray-700 mb-1">
            Versión <span class="text-red-600" aria-hidden="true">*</span>
          </label>
          <input id="version" type="number" name="version" min="1" required inputmode="numeric"
                 value="{{ old('version', $objetivo->version ?? 1) }}"
                 aria-required="true"
                 aria-invalid="{{ $errors->has('version') ? 'true' : 'false' }}"
                 aria-describedby="{{ $errors->has('version') ? 'err-version' : '' }}"
                 class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm
                        focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
          @error('version')
            <p id="err-version" class="mt-1 text-xs text-red-600" role="alert">{{ $message }}</p>
          @enderror
        </div>

        {{-- Descripción --}}
        <div class="md:col-span-2">
          <label for="descripcion" class="block text-sm font-medium text-gray-700 mb-1">
            Descripción <span class="text-red-600" aria-hidden="true">*</span>
          </label>
          <textarea id="descripcion" name="descripcion" rows="3" required
                    aria-required="true"
                    aria-invalid="{{ $errors->has('descripcion') ? 'true' : 'false' }}"
                    aria-describedby="{{ $errors->has('descripcion') ? 'err-descripcion' : '' }}"
                    class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm
                           focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">{{ old('descripcion', $objetivo->descripcion) }}</textarea>
          @error('descripcion')
            <p id="err-descripcion" class="mt-1 text-xs text-red-600" role="alert">{{ $message }}</p>
          @enderror
        </div>

        {{-- Estado --}}
        <div class="md:col-span-2">
          <label for="estado" class="block text-sm font-medium text-gray-700 mb-1">
            Estado <span class="text-red-600" aria-hidden="true">*</span>
          </label>
          <select id="estado" name="estado" required
                  aria-required="true"
                  aria-invalid="{{ $errors->has('estado') ? 'true' : 'false' }}"
                  aria-describedby="{{ $errors->has('estado') ? 'err-estado' : '' }}"
                  class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm bg-white
                         focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
            <option value="ACTIVO" {{ old('estado', $objetivo->estado) === 'ACTIVO' ? 'selected' : '' }}>Activo</option>
            <option value="INACTIVO" {{ old('estado', $objetivo->estado) === 'INACTIVO' ? 'selected' : '' }}>Inactivo</option>
          </select>
          @error('estado')
            <p id="err-estado" class="mt-1 text-xs text-red-600" role="alert">{{ $message }}</p>
          @enderror
        </div>

        {{-- Fecha registro --}}
        <div>
          <label for="fecha_registro" class="block text-sm font-medium text-gray-700 mb-1">
            Fecha de registro <span class="text-red-600" aria-hidden="true">*</span>
          </label>
          <input id="fecha_registro" type="date" name="fecha_registro" required
                 value="{{ old('fecha_registro', \Carbon\Carbon::parse($objetivo->fecha_registro)->format('Y-m-d')) }}"
                 aria-required="true"
                 aria-invalid="{{ $errors->has('fecha_registro') ? 'true' : 'false' }}"
                 aria-describedby="{{ $errors->has('fecha_registro') ? 'err-fecha' : '' }}"
                 class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm
                        focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
          @error('fecha_registro')
            <p id="err-fecha" class="mt-1 text-xs text-red-600" role="alert">{{ $message }}</p>
          @enderror
        </div>

        {{-- PND --}}
        @isset($pnds)
        <div>
          <label for="pnd_id" class="block text-sm font-medium text-gray-700 mb-1">
            PND
          </label>
          <select id="pnd_id" name="pnd_id"
                  class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm bg-white
                         focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
            <option value="">— Seleccione —</option>
            @foreach ($pnds as $id => $nombre)
              <option value="{{ $id }}" {{ (string) old('pnd_id', $objetivo->pnd_id ?? '') === (string) $id ? 'selected' : '' }}>
                {{ $nombre }}
              </option>
            @endforeach
          </select>
        </div>
        @endisset

        {{-- ODS --}}
        @isset($ods)
        <div>
          <label for="ods_id" class="block text-sm font-medium text-gray-700 mb-1">
            ODS
          </label>
          <select id="ods_id" name="ods_id"
                  class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm bg-white
                         focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
            <option value="">— Seleccione —</option>
            @foreach ($ods as $id => $nombre)
              <option value="{{ $id }}" {{ (string) old('ods_id', $objetivo->ods_id ?? '') === (string) $id ? 'selected' : '' }}>
                {{ $nombre }}
              </option>
            @endforeach
          </select>
        </div>
        @endisset

      </div>

      <div class="flex justify-end gap-3 pt-4 border-t border-gray-100">
        <a href="{{ route('objetivos.index') }}"
           class="btn-secondary">
          Volver
        </a>

        <button type="submit" class="btn-primary">
          Guardar cambios
        </button>
      </div>

    </form>
  </section>

</main>
@endsection
