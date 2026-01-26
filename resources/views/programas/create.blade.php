@extends('layouts.app')

@section('title','Nuevo programa')


@section('content')
<div class="max-w-4xl mx-auto py-8">

    {{-- Header --}}
    <div class="mb-6">
        <h1 class="text-xl font-semibold text-gray-900">Crear Programa</h1>
        <p class="text-sm text-gray-500 mt-1">
            Registra un nuevo programa institucional.
        </p>
    </div>

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

    {{-- Card --}}
    <div class="bg-white border border-gray-200 rounded-xl shadow-sm p-6">
        <form method="POST" action="{{ route('programas.store') }}" class="space-y-6">
            @csrf

            {{-- Campos reutilizables --}}
            @include('programas._form', ['prog' => $programa])

            {{-- Botones --}}
            <div class="flex justify-end gap-3 pt-4 border-t border-gray-100">
                <a href="{{ route('programas.index') }}"
                   class="inline-flex items-center justify-center rounded-lg border border-gray-300 px-4 py-2 text-sm font-semibold text-gray-700 hover:bg-gray-50">
                    Volver
                </a>

                <button type="submit"
                        class="inline-flex items-center justify-center rounded-lg bg-indigo-600 px-4 py-2 text-sm font-semibold text-white hover:bg-indigo-700">
                    Guardar
                </button>
            </div>
        </form>
    </div>

</div>
@endsection
