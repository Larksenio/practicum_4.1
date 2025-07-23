@extends('layouts.app')

@section('header')<h2 class="text-2xl font-bold">ODS</h2>@endsection

@section('content')
<a href="{{ route('ods.create') }}">
   + Nuevo ODS
</a>

<table class="w-full border">
  <thead class="bg-gray-100">
    <tr>
      <th class="p-2">Código</th><th>Meta</th><th>Nombre</th><th>Acciones</th>
    </tr>
  </thead>
  <tbody>
  @forelse ($ods as $o)
    <tr class="border-t">
      <td class="p-2">{{ $o->codigo }}</td>
      <td>{{ $o->meta }}</td>
      <td>{{ $o->nombre }}</td>
      <td class="space-x-2">
        <a href="{{ route('ods.edit',$o) }}" class="text-blue-600 underline">Editar</a>
        <form action="{{ route('ods.destroy',$o) }}" method="POST" class="inline"
              onsubmit="return confirm('¿Eliminar ODS?')">
          @csrf @method('DELETE')
          <button class="text-red-600 underline">Eliminar</button>
        </form>
      </td>
    </tr>
  @empty
    <tr><td colspan="4" class="p-4 text-center">Sin registros.</td></tr>
  @endforelse
  </tbody>
</table>

{{ $ods->links() }}
@endsection
