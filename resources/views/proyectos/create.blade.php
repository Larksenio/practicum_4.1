@extends('layouts.app')

@section('title','Nuevo Proyecto')

@section('content')
<div class="max-w-4xl mx-auto py-8">

    <header class="mb-6">
        <h1 class="text-xl font-semibold text-gray-900">Crear proyecto</h1>
        <p class="text-sm text-gray-500">
            Registra un nuevo proyecto institucional.
        </p>
    </header>

    @if ($errors->any())
        <div class="mb-4 rounded-lg bg-red-50 p-4 text-sm text-red-700">
            <ul class="list-disc pl-5 space-y-1">
                @foreach ($errors->all() as $e)
                    <li>{{ $e }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('proyectos.store') }}"
          method="POST"
          class="bg-white border border-gray-200 rounded-xl shadow-sm p-6 space-y-6">

        @csrf

        {{-- Institución --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">
                Institución
            </label>
            <select name="idInstitucion" required
                    class="w-full rounded-lg border-gray-300 px-3 py-2">
                @foreach($instituciones as $inst)
                    <option value="{{ $inst->idInstitucion }}"
                        @selected(old('idInstitucion') == $inst->idInstitucion)>
                        {{ $inst->nombre }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Código</label>
                <input type="number" name="codigo" required
                       value="{{ old('codigo') }}"
                       class="w-full rounded-lg border-gray-300 px-3 py-2">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Nombre</label>
                <input type="text" name="nombre" required
                       value="{{ old('nombre') }}"
                       class="w-full rounded-lg border-gray-300 px-3 py-2">
            </div>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Descripción</label>
            <textarea name="descripcion" rows="3"
                      class="w-full rounded-lg border-gray-300 px-3 py-2">{{ old('descripcion') }}</textarea>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Estado</label>
                <input type="text" name="estado" required
                       value="{{ old('estado','activo') }}"
                       class="w-full rounded-lg border-gray-300 px-3 py-2">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Tipología</label>
                <input type="text" name="tipologia" required
                       value="{{ old('tipologia') }}"
                       class="w-full rounded-lg border-gray-300 px-3 py-2">
            </div>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Actividades</label>
            <textarea name="actividades" rows="2"
                      class="w-full rounded-lg border-gray-300 px-3 py-2">{{ old('actividades') }}</textarea>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Fecha inicio</label>
                <input type="date" name="fecha_inicio" required
                       value="{{ old('fecha_inicio') }}"
                       class="w-full rounded-lg border-gray-300 px-3 py-2">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Fecha fin</label>
                <input type="date" name="fecha_fin"
                       value="{{ old('fecha_fin') }}"
                       class="w-full rounded-lg border-gray-300 px-3 py-2">
            </div>
        </div>

        <div class="flex justify-end gap-3 pt-4 border-t">
            <a href="{{ route('proyectos.index') }}" class="btn-secondary">
                Volver
            </a>
            <button type="submit" class="btn-primary">
                Guardar proyecto
            </button>
        </div>
    </form>
</div>
@endsection
