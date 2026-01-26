@extends('layouts.app')

@section('title', 'Editar institución')

@section('content')
<main class="mt-6 max-w-5xl mx-auto" role="main" aria-labelledby="page-title">
  <section class="card">
    <header class="mb-4">
      <h1 id="page-title" class="text-xl font-semibold mb-1">Editar institución</h1>
      <p class="text-sm text-gray-500">
        Actualiza la información de la institución y guarda los cambios.
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

    <form action="{{ route('instituciones.update', ['institucion' => $institucion->idInstitucion]) }}"
          method="POST"
          class="space-y-6"
          aria-describedby="{{ $errors->any() ? 'form-errors' : '' }}">
      @csrf
      @method('PUT')

      @include('instituciones._form', [
        'inst'   => $institucion,
        'padres' => $padres,
      ])

      <div class="flex justify-end gap-3 pt-4 border-t border-gray-100">
        <a href="{{ route('instituciones.index') }}" class="btn-secondary">
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
