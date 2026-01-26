@extends('layouts.app')

@section('title','Nuevo PND')

@section('content')
<div class="max-w-6xl mx-auto py-8">

    <div class="mb-4">
        <h1 class="text-xl font-semibold text-gray-900">Crear PND</h1>
        <p class="text-sm text-gray-500 mt-1">
            Completa la información del Plan Nacional de Desarrollo y guarda los cambios.
        </p>
    </div>

    @if ($errors->any())
        <div class="mb-4 rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-red-700">
            <ul class="list-disc pl-5 space-y-1 text-sm">
                @foreach ($errors->all() as $e)
                    <li>{{ $e }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="bg-white border border-gray-200 rounded-xl shadow-sm">
        <form action="{{ route('pnds.store') }}" method="POST" class="p-6">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                {{-- Código --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Código</label>
                    <input
                        name="codigo"
                        type="number"
                        required
                        value="{{ old('codigo') }}"
                        class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                    >
                </div>

                {{-- Eje --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Eje</label>
                    <select
                        name="eje_id"
                        required
                        class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                    >
                        <option value="">-- Seleccione --</option>
                        @foreach($ejes as $eje)
                            <option value="{{ $eje->id }}" {{ old('eje_id') == $eje->id ? 'selected' : '' }}>
                                {{ $eje->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Nombre --}}
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nombre</label>
                    <input
                        name="nombre"
                        type="text"
                        required
                        value="{{ old('nombre') }}"
                        class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                    >
                </div>

                {{-- Descripción --}}
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Descripción</label>
                    <textarea
                        name="descripcion"
                        rows="4"
                        required
                        class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                    >{{ old('descripcion') }}</textarea>
                </div>
            </div>

            <div class="flex justify-end gap-3 pt-6 mt-6 border-t border-gray-100">
                <a href="{{ route('pnds.index') }}" class="btn-secondary">Volver</a>
                <button type="submit" class="btn-primary">Guardar</button>
            </div>
        </form>
    </div>

</div>
@endsection
