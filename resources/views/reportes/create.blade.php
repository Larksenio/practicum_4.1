@extends('layouts.app')

@section('title', 'Nuevo Reporte')

@section('content')
<div class="max-w-5xl mx-auto py-8">

    {{-- Header --}}
    <div class="mb-5">
        <h1 class="text-xl font-semibold text-gray-900">Crear reporte</h1>
        <p class="text-sm text-gray-500 mt-1">
            Completa la información del reporte y guarda los cambios.
        </p>
    </div>

    {{-- Errores --}}
    @if ($errors->any())
        <div class="mb-4 rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
            <ul class="list-disc pl-5 space-y-1">
                @foreach ($errors->all() as $e)
                    <li>{{ $e }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Card --}}
    <div class="bg-white border border-gray-200 rounded-2xl shadow-sm p-6">
        <form action="{{ route('reportes.store') }}" method="POST" class="space-y-6">
            @csrf

            {{-- Grid superior --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                {{-- Nombre --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nombre <span class="text-red-500">*</span></label>
                    <input type="text"
                           name="nombre"
                           value="{{ old('nombre') }}"
                           required
                           class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm
                                  focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                </div>

                {{-- Tipo --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Tipo <span class="text-red-500">*</span></label>
                    <select name="tipo"
                            required
                            class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm bg-white
                                   focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                        @foreach (['PDF', 'Excel', 'Web'] as $t)
                            <option value="{{ $t }}" @selected(old('tipo', 'PDF') == $t)>{{ $t }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Responsable --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Responsable <span class="text-red-500">*</span></label>
                    <select name="responsable_id"
                            required
                            class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm bg-white
                                   focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                        <option value="">— Seleccione —</option>
                        @foreach ($usuarios as $id => $nom)
                            <option value="{{ $id }}" @selected(old('responsable_id') == $id)>{{ $nom }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Fecha --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Fecha de creación</label>
                    <input type="date"
                           name="fecha_creacion"
                           value="{{ old('fecha_creacion', now()->toDateString()) }}"
                           class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm
                                  focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                </div>
            </div>

            {{-- Textareas --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Antecedentes</label>
                    <textarea name="antecedentes" rows="5"
                              class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm
                                     focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">{{ old('antecedentes') }}</textarea>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Desarrollo</label>
                    <textarea name="desarrollo" rows="5"
                              class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm
                                     focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">{{ old('desarrollo') }}</textarea>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Conclusiones</label>
                    <textarea name="conclusiones" rows="5"
                              class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm
                                     focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">{{ old('conclusiones') }}</textarea>
                </div>
            </div>

            {{-- Acciones --}}
            <div class="pt-4 border-t border-gray-100 flex items-center justify-end gap-3">
                <a href="{{ route('reportes.index') }}"
                   class="text-sm font-semibold text-gray-700 hover:text-gray-900">
                    Volver
                </a>

                <button type="submit"
                        class="px-4 py-2 rounded-lg bg-indigo-600 text-white text-sm font-semibold
                               hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    Guardar
                </button>
            </div>
        </form>
    </div>

</div>
@endsection
