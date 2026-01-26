@extends('layouts.app')

@section('title', 'Crear institución')

@section('content')
<main class="max-w-5xl mx-auto mt-6" role="main" aria-labelledby="page-title">
  <section class="bg-white rounded-xl shadow-sm border border-gray-100 p-8">

    <header class="mb-6">
      <h1 id="page-title" class="text-xl font-semibold text-gray-900">
        Crear institución
      </h1>
      <p class="text-sm text-gray-500">
        Completa la información de la institución y guarda los cambios.
      </p>
    </header>

    @if ($errors->any())
      <div class="mb-4 rounded-lg bg-red-50 px-4 py-3 text-sm text-red-700" role="alert" aria-live="polite">
        <p class="font-semibold mb-2">Revisa los campos:</p>
        <ul class="list-disc pl-5 space-y-1">
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <form action="{{ route('instituciones.store') }}" method="POST" class="space-y-6" novalidate>
      @csrf

      @include('instituciones._form', ['inst' => $inst, 'padres' => $padres])

      <div class="flex justify-end gap-3 pt-4 border-t border-gray-100">
        <a href="{{ route('instituciones.index') }}" class="btn-secondary">
          Volver
        </a>
        <button type="submit" class="btn-primary">
          Guardar
        </button>
      </div>
    </form>
  </section>
</main>
@endsection
