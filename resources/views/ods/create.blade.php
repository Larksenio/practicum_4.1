@extends('layouts.app')

@section('header')<h2 class="text-2xl font-bold">
    {{ isset($od) ? 'Editar ODS' : 'Nuevo ODS' }}
</h2>@endsection

@section('content')
@if($errors->any())
 <ul class="mb-4 list-disc pl-6 text-red-600">
  @foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach
 </ul>
@endif

<form action="{{ isset($od) ? route('ods.update',$od) : route('ods.store') }}"
      method="POST" class="space-y-4 max-w-md">
  @csrf
  @isset($od) @method('PUT') @endisset

  <div>
    <label class="font-semibold">Código</label>
    <input name="codigo" type="number" required
           value="{{ old('codigo', $od->codigo ?? '') }}"
           class="w-full border rounded px-2 py-1">
  </div>

  <div>
    <label class="font-semibold">Meta (1-17)</label>
    <input name="meta" type="number" min="1" max="17" required
           value="{{ old('meta', $od->meta ?? '') }}"
           class="w-full border rounded px-2 py-1">
  </div>

  <div>
    <label class="font-semibold">Nombre</label>
    <input name="nombre" type="text" required
           value="{{ old('nombre', $od->nombre ?? '') }}"
           class="w-full border rounded px-2 py-1">
  </div>

  <div>
    <label class="font-semibold">Descripción</label>
    <textarea name="descripcion" rows="3" required
              class="w-full border rounded px-2 py-1">{{ old('descripcion', $od->descripcion ?? '') }}</textarea>
  </div>

  <button class="px-4 py-2 bg-blue-600 text-black rounded">Guardar</button>
  <a href="{{ route('ods.index') }}" class="ml-4 underline text-blue-600">Cancelar</a>
</form>
@endsection
