@extends('layouts.app')

@section('header')<h2 class="text-2xl font-bold">Nuevo PND</h2>@endsection

@section('content')
@if($errors->any())
 <ul class="mb-4 text-red-600 list-disc pl-6">
  @foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach
 </ul>
@endif

<form action="{{ route('pnds.store') }}" method="POST" class="space-y-4 max-w-md">
 @csrf
 <div>
   <label class="font-semibold">Código</label>
   <input name="codigo" type="number" required value="{{ old('codigo') }}"
          class="w-full border rounded px-2 py-1">
 </div>

 <div>
   <label class="font-semibold">Nombre</label>
   <input name="nombre" type="text" required value="{{ old('nombre') }}"
          class="w-full border rounded px-2 py-1">
 </div>

 <div>
   <label class="font-semibold">Eje</label>
   <input name="eje" type="text" required value="{{ old('eje') }}"
          class="w-full border rounded px-2 py-1">
 </div>

 <div>
   <label class="font-semibold">Descripción</label>
   <textarea name="descripcion" rows="3" required
             class="w-full border rounded px-2 py-1">{{ old('descripcion') }}</textarea>
 </div>

 <button class="px-4 py-2 bg-blue-600 text-black rounded">Guardar</button>
 <a href="{{ route('pnds.index') }}" class="ml-4 underline text-blue-600">Cancelar</a>
</form>
@endsection
