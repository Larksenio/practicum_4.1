@extends('layouts.app')

@section('title', 'Alinear')

@section('content')
<h2 class="text-xl font-bold mb-4">
    Alinear Proyecto: {{ $proyecto->nombre }}
</h2>

<form action="{{ route('alinear.update', $proyecto) }}" method="POST" class="space-y-3">
  @csrf @method('PUT')

  <div class="grid grid-cols-1 gap-2">
      @foreach ($objetivos as $obj)
          <label class="flex items-center space-x-2">
              <input type="checkbox" name="objetivos[]" value="{{ $obj->id }}"
                     @checked($proyecto->objetivos->contains($obj->id))>
              <span>{{ $obj->descripcion }}</span>
          </label>
      @endforeach
  </div>

  <button class="mt-4 px-4 py-1 bg-indigo-600 text-white rounded">Guardar</button>
  <a href="{{ route('proyectos.index') }}" class="ml-3 text-gray-600">Volver</a>
</form>
@endsection
