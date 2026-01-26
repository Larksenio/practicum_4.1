@extends('layouts.app')

@section('title','Editar Plan')

@section('content')
<div class="max-w-4xl mx-auto py-8">

  <div class="bg-white border border-gray-200 rounded-2xl shadow-sm p-6">
    <h1 class="text-xl font-semibold text-gray-900">Editar Plan</h1>
    <p class="text-sm text-gray-500 mb-6">
      Actualiza la información del plan y guarda los cambios.
    </p>

    {{-- IMPORTANTE: pasar el modelo completo --}}
    <form method="POST" action="{{ route('planes.update', $plan) }}" class="space-y-6">
      @csrf
      @method('PUT')

      @include('planes._form', ['plan' => $plan])

      <div class="flex justify-end gap-3 pt-4 border-t border-gray-100">
        <a href="{{ route('planes.index') }}"
           class="rounded-lg border border-gray-300 px-4 py-2 text-sm font-semibold text-gray-700 hover:bg-gray-50">
          Volver
        </a>

        <button type="submit"
                class="rounded-lg bg-indigo-600 px-4 py-2 text-sm font-semibold text-white hover:bg-indigo-700">
          Actualizar
        </button>
      </div>
    </form>

  </div>

</div>
@endsection
