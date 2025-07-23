@extends('layouts.app')

@section('title', 'Nuevo objetivo')

@section('header')
    <h2 class="text-2xl font-bold">Registrar objetivo</h2>
@endsection

@section('content')
    {{-- errores ------------------------------------------------------------- --}}
    @if ($errors->any())
        <ul class="mb-4 list-disc pl-6 text-red-600">
            @foreach ($errors->all() as $e) <li>{{ $e }}</li> @endforeach
        </ul>
    @endif

    {{-- formulario ---------------------------------------------------------- --}}
    <form action="{{ route('objetivos.store') }}" method="POST" class="max-w-lg space-y-4">
        @csrf

        {{-- Código --}}
        <div>
            <label class="block font-semibold">Código</label>
            <input type="number"
                   name="codigo"
                   required
                   value="{{ old('codigo') }}"
                   class="w-full border rounded px-2 py-1">
        </div>

        {{-- Descripción --}}
        <div>
            <label class="block font-semibold">Descripción</label>
            <textarea name="descripcion"
                      required
                      rows="3"
                      class="w-full border rounded px-2 py-1">{{ old('descripcion') }}</textarea>
        </div>
         {{-- Estado --}}
        <div>
            <label class="block font-semibold">Estado</label>
            <textarea name="estado"
                      required
                      rows="3"
                      class="w-full border rounded px-2 py-1">{{ old('estado') }}</textarea>
        </div>

        {{-- Versión --}}
        <div>
            <label class="block font-semibold">Versión</label>
            <input type="number"
                   name="version"
                   min="1"
                   required
                   value="{{ old('version', 1) }}"
                   class="w-full border rounded px-2 py-1">
        </div>

        {{-- Fecha registro --}}
        <div>
            <label class="block font-semibold">Fecha de registro</label>
            <input type="date"
                   name="fecha_registro"
                   required
                   value="{{ old('fecha_registro', now()->format('Y-m-d')) }}"
                   class="w-full border rounded px-2 py-1">
        </div>

        {{-- Relación con PND (opcional) --}}
        @isset($pnds)
        <div>
            <label class="block font-semibold">PND</label>
            <select name="pnd_id" class="w-full border rounded px-2 py-1">
                <option value="">— Seleccione —</option>
                @foreach ($pnds as $id => $nombre)
                    <option value="{{ $id }}"
                            {{ old('pnd_id') == $id ? 'selected' : '' }}>
                        {{ $nombre }}
                    </option>
                @endforeach
            </select>
        </div>
        @endisset

        {{-- Relación con ODS (opcional) --}}
        @isset($ods)
        <div>
            <label class="block font-semibold">ODS</label>
            <select name="ods_id" class="w-full border rounded px-2 py-1">
                <option value="">— Seleccione —</option>
                @foreach ($ods as $id => $nombre)
                    <option value="{{ $id }}"
                            {{ old('ods_id') == $id ? 'selected' : '' }}>
                        {{ $nombre }}
                    </option>
                @endforeach
            </select>
        </div>
        @endisset

        {{-- Botones --}}
        <div class="pt-4">
            <button class="px-4 py-2 bg-blue-600 text-white rounded">
                Guardar
            </button>
            <a href="{{ route('objetivos.index') }}"
               class="ml-4 underline text-blue-600">Cancelar</a>
        </div>
    </form>
@endsection
