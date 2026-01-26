@extends('layouts.app')

@section('title','Editar proyecto')

@section('content')
<div class="max-w-4xl mx-auto py-8">
    <div class="bg-white border border-gray-200 rounded-2xl shadow-sm p-6">

        <h1 class="text-xl font-semibold text-gray-900">
            Editar proyecto
        </h1>
        <p class="text-sm text-gray-500 mb-6">
            Actualiza la información del proyecto y guarda los cambios.
        </p>

        {{-- Errores --}}
        @if ($errors->any())
            <div class="mb-4 rounded-lg bg-red-50 px-4 py-3 text-sm text-red-700">
                <ul class="list-disc pl-5 space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('proyectos.update', $proyecto->idProyecto) }}"
              method="POST"
              class="space-y-6">
            @csrf
            @method('PUT')

            {{-- Institución --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Institución
                </label>
                <select name="idInstitucion"
                        required
                        class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    @foreach($instituciones as $inst)
                        <option value="{{ $inst->idInstitucion }}"
                            {{ $proyecto->idInstitucion == $inst->idInstitucion ? 'selected' : '' }}>
                            {{ $inst->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Código + Nombre --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Código
                    </label>
                    <input type="number"
                           name="codigo"
                           value="{{ old('codigo', $proyecto->codigo) }}"
                           required
                           class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Nombre
                    </label>
                    <input type="text"
                           name="nombre"
                           value="{{ old('nombre', $proyecto->nombre) }}"
                           required
                           class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                </div>
            </div>

            {{-- Descripción --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Descripción
                </label>
                <textarea name="descripcion"
                          rows="3"
                          class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('descripcion', $proyecto->descripcion) }}</textarea>
            </div>

            {{-- Estado + Tipología --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="estado" class="block text-sm font-medium text-gray-700 mb-1">Estado</label>
                    <select id="estado" name="estado"
                     class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    <option value="activo"   @selected(old('estado', $proyecto->estado) == 'activo')>Activo</option>
                     <option value="inactivo" @selected(old('estado', $proyecto->estado) == 'inactivo')>Inactivo</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Tipología
                    </label>
                    <input type="text"
                           name="tipologia"
                           value="{{ old('tipologia', $proyecto->tipologia) }}"
                           class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                </div>
            </div>

            {{-- Actividades --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Actividades
                </label>
                <textarea name="actividades"
                          rows="3"
                          class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('actividades', $proyecto->actividades) }}</textarea>
            </div>

            {{-- Fechas --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Fecha de inicio
                    </label>
                    <input type="date"
                           name="fecha_inicio"
                           value="{{ old('fecha_inicio', $proyecto->fecha_inicio) }}"
                           required
                           class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Fecha de fin
                    </label>
                    <input type="date"
                           name="fecha_fin"
                           value="{{ old('fecha_fin', $proyecto->fecha_fin) }}"
                           class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                </div>
            </div>

            {{-- Botones --}}
            <div class="flex justify-end gap-3 pt-4 border-t border-gray-100">
                <a href="{{ route('proyectos.index') }}" class="btn-secondary">
                    Volver
                </a>
                <button type="submit" class="btn-primary">
                    Actualizar
                </button>
            </div>

        </form>
    </div>
</div>
@endsection
